<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TournamentLiveAccount;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\TournamentModel as Tournament;
use App\Services\MT5Service;
use App\MT5\MTRetCode;
use App\MT5\MTEnDealAction;
use App\Models\TournamentLiveAccount as LiveAccount;
use App\Models\User;
use App\Models\Mt5_account;
use App\Services\MailService as MailService;
use App\Models\TournamentOrders as Orders;
use App\Models\UserGroup;

class Tournaments extends Controller
{
    protected $api;
    protected $mailService;
    protected $mt5Service;
    public function __construct(MT5Service $mt5Service, MailService $mailService)
    {
        $this->mailService = $mailService;
        $this->mt5Service = $mt5Service;
        $this->api = $this->mt5Service->getApi();
    }
    public function index()
    {
        $eid = session('clogin');
        $user_groups = UserGroup::find(session('user')['group_id']);
        $user_group_id=$user_groups['user_group_id'];

        $account_type = 0;
        $status = 1;
        $account_types = DB::table('liveaccount')
            ->where('email', $eid)
            ->distinct()
            ->pluck('account_type')
            ->toArray();
        $tournaments = DB::table('tournaments')
            ->select('tournaments.*', 'tournament_liveaccount.trade_id')
            ->leftjoin('tournament_liveaccount', 'tournaments.id', '=', 'tournament_liveaccount.tournament_id')
            ->where(function ($query) use ($eid, $account_types,$user_group_id) {
                $query->whereRaw('FIND_IN_SET(?, tournaments.shows_list) > 0 AND tournaments.shows_on = "users"', [$eid])
                    ->orWhere(function ($subQuery) use ($account_types) {
                        foreach ($account_types as $account_type) {
                            $subQuery->orWhereRaw('FIND_IN_SET(?, tournaments.shows_list) > 0 AND tournaments.shows_on = "groups"', [$account_type]);
                        }
                    })
                    ->orWhere(function ($subQuery) use ($user_group_id) {
                        $subQuery->whereRaw('FIND_IN_SET(?, tournaments.shows_list) > 0 AND tournaments.shows_on = "user_groups"', [$user_group_id]);
                    })
                    ->orWhere('tournaments.shows_on', 'all');
            })
            ->where('tournaments.status', 1)
            ->whereRaw('NOW() BETWEEN tournaments.starts_at AND tournaments.ends_at')
            ->orderBy('tournaments.id', 'desc')
            ->get();
        return view('tournaments', compact('tournaments'));
    }
    public function details(Request $request)
    {
        $id = $request->input('id');
        $tournament = DB::table('tournaments')
            ->select('tournaments.*', 'tournament_liveaccount.trade_id')
            ->leftJoin('tournament_liveaccount', 'tournaments.id', '=', 'tournament_liveaccount.tournament_id')
            ->whereRaw('MD5(tournaments.id) = ?', [$id])
            ->first();
        return view('tournament_details', compact('tournament'));
    }
    public function getLiveaccount(Request $request)
    {
		/*Get the league Details*/
		$id = $request->input('leagueid');
		$leaguesval = DB::table('leagues')->whereRaw('MD5(id) = ?', [$id])->first();
		
        $settings = Mt5_account::where('id', $leaguesval->mt5_server_id)->first();
        $this->mt5Service->connect($leaguesval->mt5_server_id);
        $user = User::where('id', auth()->id())->first();
	
        $enrolled = LiveAccount::where('tournament_id', $leaguesval->id)->where('tournament_id', $user['email'])->first();
        if ($enrolled) {
            return response()->json([
                'message' => 'Already live account details are shared',
            ], 400);
        }
        
        $group = DB::table('account_types')->where('ac_index', $leaguesval->Mt5groupid)->first();
		
        $new_user = $this->api->UserCreate();
        $new_user->MainPassword = $this->generatePassword();
        $new_user->Group = $group->ac_group;
        $new_user->Leverage = $group->ac_max_leverage;
        $new_user->ZipCode = '000000';
        $new_user->Country = 'UAE';
        $new_user->State = 'Test';
        $new_user->City = 'Test';
        $new_user->Address = 'Test';
        $new_user->Phone = $user['phone'];
        $new_user->Currency = 'USD';
        $new_user->Status = 1;
        $new_user->Company = $settings['mt5_company_name'];
        $new_user->Name = $user['name'];
        $new_user->Email = $user['email'];
        $new_user->LeadSource = 'noIB';
        $new_user->PhonePassword = $this->generatePassword();
        $new_user->InvestPassword = $this->generatePassword();
        $new_user->Login = $this->generateRandomNumber();
        $response = $this->CreateAccount($new_user, $user_server, 'Live', $leaguesval->mt5_server_id);
        if ($response['status']) {
            $comment = 'Contest Deposit Amount';
            if (($error_code = $this->api->UserDepositChange($new_user->Login, $group->ac_min_deposit, $comment, $type = MTEnDealAction::DEAL_BALANCE)) != MTRetCode::MT_RET_OK) {
                $error = MTRetCode::GetError($error_code);
                return ["status" => false, "message" => $error];
            } else {
                 LiveAccount::create([
                    'tournament_id' => $leaguesval->id,
                    'email' => $new_user->Email,
                    'name' => $new_user->Name,
                    'trade_id' => $new_user->Login,
                    'account_type' => $leaguesval->Mt5groupid,
                    'leverage' => $new_user->Leverage,
                    'currency' => $new_user->Currency,
                    'Balance' => $group->ac_min_deposit,
                    'trader_pwd' => $new_user->MainPassword,
                    'invester_pwd' => $new_user->InvestPassword,
                    'phone_pwd' => $new_user->PhonePassword,
                    'ib1' => $new_user->LeadSource,                
                ]);
                if ($leaguesval->send_notification == 1 && $user['user_type'] != 5) {
                    $this->sendMail($new_user, 'Live', $leaguesval->email_description, $leaguesval->mt5_server_id, $leaguesval->leagurTitle);
                }
                return response()->json(['success' => 'Enrolled Successfully']);
            }
        } else {
            return response()->json([
                'message' => 'Error enrolling tournament',
            ], 400);
        }
    }


    function CreateAccount($user, &$user_server, $type, $serverid)
    {
        $settings = Mt5_account::where('id', $serverid)->first();
        if (!$this->api->IsConnected()) {
            $errorCode = $this->api->Connect(
                $settings['mt5_server_ip'],
                $settings['mt5_server_port'],
                300,
                $settings['mt5_server_web_login'],
                $settings['mt5_server_web_password']
            );
            if ($errorCode != MTRetCode::MT_RET_OK) {
                $error = MTRetCode::GetError($errorCode);
                return ["status" => false, "message" => $error];
            }
        }
        if (($error_code = $this->api->UserAdd($user, $user_server)) != MTRetCode::MT_RET_OK) {
            $error = MTRetCode::GetError($error_code);
            return ["status" => false, "message" => $error];
        } else {
            return ["status" => true, "message" => $type . " Account Created Successfully"];
        }
    }

    public function sendMail($new_user, $type, $email_content, $serverid, $leagueTitle)
    {
        $settings = Mt5_account::where('id', $serverid)->first();
        $toEmail = $new_user->Email;
        
        
        $emailSubject = 'Your Contest Account Details – PROFXSPORTSCLUB '.$leagueTitle;

        $templateVars = [
            'name'         => $new_user->Name,
            'type'         => $type,
            'trade_id'     => $new_user->Login,
            'trader_pwd'   => $new_user->MainPassword,
            'investor_pwd' => $new_user->InvestPassword,
            'leverage'     => "1:" . $new_user->Leverage,
            'server_name'  => $settings['mt5_company_name'],
            'email'        => 'noreply@profxleague.com',
            "title_right"  => "Get Started With",
            "subtitle_right" => "New " . $type . " MT5 Account",
            "content"      => $email_content ?: "<p>Your account has been created successfully.</p>"
        ];
        
        // Pass Blade template instead of raw headers
        $this->mailService->sendEmail(
            $toEmail, 
            $emailSubject, 
            [],   // attachments if any
            'emails.mt5accountdetails', 
            $templateVars
        );
    }
    public function generatePassword($length = 8)
    {
        // Define character pools
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '@#$';
        // Ensure at least one character from each pool is included
        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];
        // Combine all pools for the remaining characters
        $allCharacters = $uppercase . $lowercase . $numbers . $specialChars;
        // Generate the remaining characters
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
        }
        // Shuffle the password to avoid predictable patterns
        $password = str_shuffle($password);
        return $password;
    }
    function generateRandomNumber($length = 6)
    {
        $min = pow(10, $length - 1); // Minimum value for an 8-digit number (10000000)
        $max = pow(10, $length) - 1;  // Maximum value for an 8-digit number (99999999)
        return rand($min, $max);
    }
    public function getTradeHistory(Request $request)
    {
        $login = $request->input('trade_id');
        $from = 'September 01,2024';
        $to = 'March 31,2080';
        $total = 0;
        if (($error_code = $this->api->PositionGetTotal($login, $total)) != MTRetCode::MT_RET_OK) {
            return response()->json(['error' => MTRetCode::GetError($error_code)]);
        }
        $open_order_history = $total;
        $offset = 0;
        $positions = [];
        if (($error_code = $this->api->PositionGetPage($login, $offset, $total, $positions)) != MTRetCode::MT_RET_OK) {
            return response()->json(['error' => MTRetCode::GetError($error_code)]);
        }

        echo json_encode(['data' => $positions]);
    }

    public function leaderBoard()
    {
        $this->updateHistory();
        $leaderboard = Orders::with('user')->select(
            'email',
            DB::raw('SUM(profit) as profit'))
            ->groupBy('email')
            ->orderBy('profit', 'desc')
            ->limit(10)
            ->get();
        return view('leaderboard', compact('leaderboard'));
    }
    public function updateHistory()
    {
        $from = 'September 01,2024';
        $to = 'March 31,2080';
        $total = 0;
        $positions = [];
        $eid = session('clogin');
        $tournaments = TournamentLiveAccount::all();
        foreach ($tournaments as $tournament) {
            $login = $tournament->trade_id;
            if (($error_code = $this->api->DealGetTotal($login, $from, $to, $total)) != MTRetCode::MT_RET_OK) {
                continue;
            }
            $open_order_history = $total;
            $offset = 0;
            $positions = [];
            if (($error_code = $this->api->DealGetPage($login, $from, $to, $offset, $total, $orders)) != MTRetCode::MT_RET_OK) {
                continue;
            }
            // dd($orders);
            if ($orders) {
                foreach ($orders as $order) {
                    if (in_array($order->Action, [0, 1])) {
                        $time = gmdate("Y-m-d H:i:s", $order->Time);
                        Orders::updateOrCreate(
                            [
                                'order_id' => $order->Order,
                            ],
                            [
                                'tournament_id' => $tournament->tournament_id,
                                'email' => $eid,
                                'action' => $order->Action,
                                'login' => $order->Login,
                                'deal_id' => $order->Deal,
                                'symbol' => $order->Symbol,
                                'time' => $time,
                                'lot' => $order->Volume,
                                'contract_size' => $order->ContractSize,
                                'profit' => $order->Profit,
                            ]
                        );
                    }
                }
            }
        }
    }

}
