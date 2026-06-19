<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReferralCommission;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\Country;
use App\Models\Bankdetail;
use App\Models\Cryptowallet;
use App\Models\Walletwithdraw;
use App\Models\Paymentgateway;
use App\Models\PaymentLog;
use App\Models\Payment;
use App\Models\Transactions;
use App\Models\Kyc;
use App\Models\Internaltransfer;
use App\Models\League;
use App\Models\Categorie;
use App\Models\Enrollment;
use App\Models\Leagueprizes;
use App\Models\Configsetting;
use App\Models\AdminTeamBooking;
use App\Models\AdminTravelBooking;
use App\Models\AdminNetworkBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Mail\NotificationEmail;
use Mail;
use Redirect;
use Helper;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\MailService;
use Carbon\Carbon;


use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

use Barryvdh\DomPDF\Facade\Pdf;
class UserController extends Controller
{
    
    protected $mailService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MailService $mailService)
    {
        
        $this->mailService = $mailService;
    }
    public function dashboard(Request $request)
    {
        $pagetitle = "Dashboard";
// 		$overallRank = '#';
// 		$totaltranscation = WalletTransaction::where('user_id', auth()->id())->count();
// 		$wallet = Wallet::where('user_id', auth()->id())
// 			->select('balance', 'reward_balance', 'referral_balance')
// 			->first();

// 		$availableWallet = [
// 			'balance'         => $wallet->balance ?? 0.00,
// 			'reward_balance'  => $wallet->reward_balance ?? 0.00,
// 			'referral_balance'=> $wallet->referral_balance ?? 0.00,
// 		];
		
		$latestannounce = '';
        $user = Auth::user();

        $sportsBookingCount = 0;
        $travelBookingCount = 0;
        $networkBookingCount = 0;
        $approvedTransactionCount = 0;
        $rejectedTransactionCount = 0;
        $successTransactionCount = 0;

        if ($user) {
            $sportsBookingCount = AdminTeamBooking::where('user_id', $user->id)->count();
            $travelBookingCount = AdminTravelBooking::where('user_id', $user->id)->count();
            $networkBookingCount = AdminNetworkBooking::where('user_id', $user->id)->count();

            $approvedTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['approved'])
                ->count();

            $rejectedTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['rejected'])
                ->count();

            $successTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['success'])
                ->count();
        }

        $corporatePlans = $user ? Payment::where('user_id', $user->id)->latest()->get() : collect();
        $latestCorporatePlan = $corporatePlans->first();

		return view("crm.dashboard", compact(
            'pagetitle',
            'sportsBookingCount',
            'travelBookingCount',
            'networkBookingCount',
            'approvedTransactionCount',
            'rejectedTransactionCount',
            'successTransactionCount',
            'corporatePlans',
            'latestCorporatePlan'
        ));
    }
	
	public function wallet(Request $request)
    {
        $pagetitle = "Wallet";	
		$transactions = WalletTransaction::with('fromUser')->where('user_id', auth()->id())->latest()->get();
		$wallet = Wallet::where('user_id', auth()->id())
			->select('balance', 'reward_balance', 'referral_balance')
			->first();

		$availableWallet = [
			'balance'         => $wallet->balance ?? 0.00,
			'reward_balance'  => $wallet->reward_balance ?? 0.00,
			'referral_balance'=> $wallet->referral_balance ?? 0.00,
		];
		
		return view("frontEnd.user.wallet", compact('pagetitle', 'availableWallet', 'transactions'));
    }
    
public function leaguecertificate(Request $request)
{
    $user = auth()->user();
   $leaguedata = DB::table('tournament_liveaccount')
    ->join('leagues', 'leagues.id', '=', 'tournament_liveaccount.tournament_id')
    ->where('tournament_liveaccount.email', $user->email)
    ->select(
        'tournament_liveaccount.*',
        'leagues.leagurTitle',
        'leagues.leagurStartdate',
        'leagues.leagurEnddate'
    )
    ->get();
    
//   echo'<pre>';print_r($leaguedata);exit;
    return view('frontEnd.user.leaguecertificate', compact('leaguedata'));
}
    public function sendotp(Request $request)
{
    // $request->validate([
    //     'user_id' => 'required|exists:users,id'
    // ]);
//  echo'<pre>';print_r('yes');exit;
    $user = User::find($request->user_id);

    $otp = rand(100000, 999999);

    // Save OTP against this user
    $user->last_otp = $otp;
   
    $user->otp_verify = false;
    $user->save();

    // Prepare template variables
    $templateVars = [
        'name'        => $user->name,
        'server_name' => 'PROFXSPORTSCLUB',
        'site_link'   => 'https://profxleague.com',
        'email'       => $user->email,
        'otp'         => $otp,   // <-- pass OTP here
    ];

    // Send using Blade template (instead of raw)
    $this->mailService->sendEmail(
        $user->email,         
        'PROFXSPORTSCLUB - OTP Verification!', 
        [],                   
        'emails.otp_verification',   // <- create this Blade template
        $templateVars
    );

    return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
}
public function verifyotp(Request $request)
{

    // echo'<pre>';print_r($request->all());exit;
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'otp' => 'required|digits:6',
        'bank_name' => 'required|string',
        'account_number' => 'required|string',
        'account_holder' => 'required|string',
        'ifsccode' => 'required|string',
        'swift_code' => 'required|string',
        // 'bank_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // validate file
    ]);

    $user = User::find($request->user_id);

    if ($request->otp == $user->last_otp) {
        $user->otp_verify = true;
        $user->last_otp = null; // clear after success
        $user->save();

         $bankProofPath = null;
        if ($request->hasFile('bank_proof')) {
            $file = $request->file('bank_proof');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = base_path('../uploads/bank_proof');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $bankProofPath = 'uploads/bank_proof/' . $fileName;
        }

        if ($request->bank_id == null) {
          
            $bank = new BankDetail();
            $bank->user_id = $user->id;
            $bank->bank_name = $request->bank_name;
            $bank->account_number = $request->account_number;
            $bank->account_holder = $request->account_holder;
            $bank->ifsccode = $request->ifsccode;
            $bank->swift_code = $request->swift_code;
             $bank->bank_proof   = $bankProofPath;
          $bank->save();

        } else {
            $bank = BankDetail::where('id', $request->bank_id)
                               ->where('user_id', Auth::id())
                               ->firstOrFail();

            $bank->bank_name = $request->bank_name;
            $bank->account_number = $request->account_number;
            $bank->account_holder = $request->account_holder;
            $bank->ifsccode = $request->ifsccode;
            $bank->swift_code = $request->swift_code;
             $bank->bank_proof   = $bankProofPath;
             $bank->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Bank detail added/updated successfully!'
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid OTP']);
}
 public function walletsendotp(Request $request)
{
    // $request->validate([
    //     'user_id' => 'required|exists:users,id'
    // ]);
//  echo'<pre>';print_r('yes');exit;
    $user = User::find($request->user_id);

    $otp = rand(100000, 999999);

    // Save OTP against this user
    $user->last_walletotp = $otp;
   
    $user->otp_walletverify = false;
    $user->save();

    // Prepare template variables
    $templateVars = [
        'name'        => $user->name,
        'server_name' => 'PROFXSPORTSCLUB',
        'site_link'   => 'https://profxleague.com',
        'email'       => $user->email,
        'otp'         => $otp,   // <-- pass OTP here
    ];

    // Send using Blade template (instead of raw)
    $this->mailService->sendEmail(
        $user->email,         
        'PROFXSPORTSCLUB - OTP Verification!', 
        [],                   
        'emails.otp_verification',   // <- create this Blade template
        $templateVars
    );

    return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
}
public function walletverifyotp(Request $request)
{

   
    // Validate request
    $request->validate([
        'user_id'        => 'required|exists:users,id',
        'otp'            => 'required|digits:6',
        'wallet_name'    => 'required|string',
        'wallet_crypto'  => 'required|string',
        'wallet_network' => 'required|string',
        'wallet_address' => 'required|string',
        // 'wallet_proof'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // optional proof
        'status'         => 'required|in:0,1',
    ]);

    $user = User::find($request->user_id);

    if ($request->otp == $user->last_walletotp) {
        $user->otp_walletverify = true;
        $user->last_walletotp   = null; // clear OTP after success
        $user->save();

        // Handle file upload if exists
        $walletProofPath = null;
        if ($request->hasFile('wallet_proof')) {
            $file = $request->file('wallet_proof');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = base_path('../uploads/wallet_proofs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $walletProofPath = 'uploads/wallet_proofs/' . $fileName;
        }

        // Check if creating or updating
        if ($request->wallet_id == null) {
            // Create new wallet
            $cryptowallet = new Cryptowallet();
            $cryptowallet->user_id        = $user->id;
            $cryptowallet->wallet_name    = $request->wallet_name;
            $cryptowallet->wallet_crypto  = $request->wallet_crypto;
            $cryptowallet->wallet_network = $request->wallet_network;
            $cryptowallet->wallet_address = $request->wallet_address;
            $cryptowallet->status         = $request->status;
            $cryptowallet->wallet_proof   = $walletProofPath;
            $cryptowallet->save();
        } else {
            // Update existing wallet
            $cryptowallet = Cryptowallet::where('id', $request->wallet_id)
                                        ->where('user_id', $user->id)
                                        ->firstOrFail();

            $cryptowallet->update([
                'wallet_name'    => $request->wallet_name,
                'wallet_crypto'  => $request->wallet_crypto,
                'wallet_network' => $request->wallet_network,
                'wallet_address' => $request->wallet_address,
                'status'         => $request->status,
                'wallet_proof'   => $walletProofPath ?? $cryptowallet->wallet_proof, // keep old if not uploaded
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Wallet details saved successfully!'
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid OTP']);
}

 public function cryptowalletstore(Request $request)
    {
       
// echo'<pre>';print_r('yes');exit;
        $userId = auth()->id();

            $cryptowallet = new Cryptowallet();
            $cryptowallet->user_id = $userId;
            $cryptowallet->wallet_name = $request->wallet_name;
            $cryptowallet->wallet_crypto = $request->wallet_crypto;
            $cryptowallet->wallet_network = $request->wallet_network;
            $cryptowallet->wallet_address = $request->wallet_address;
            // $bank->swift_code = $request->swift_code;

            $cryptowallet->save();

        return redirect()->back()->with('success', 'Crypto detail added successfully!');
    }   
    
       public function cryptowalletstroy($id)
    {
        $bank = Cryptowallet::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $bank->delete();

        return redirect()->back()->with('success', 'Crypto wallet detail deleted successfully!');
    }
    
    public function cryptowallet(Request $request)
    {
      $user = auth()->user();

    $pagetitle = 'Bank Details';
    $wallets = Cryptowallet::where('user_id', $user->id)->get();

   
    return view('frontEnd.user.cryptowallet', compact('pagetitle', 'user','wallets'));
    }

	public function bankdetail(Request $request)
    {
      
      $user = auth()->user();

    $pagetitle = 'Bank Details';
    $banks = BankDetail::where('user_id', $user->id)->get();

   
    return view('frontEnd.user.bankdetail', compact('pagetitle', 'user','banks'));
    }
    
	public function leaderboard(Request $request)
    {
        $pagetitle = "Leader Board";
        $leaguecatlist = League::where('status', 1)->get();
    
        $today = Carbon::today()->toDateString();
        /*$activeleague = League::whereDate('leagurStartdate', '<=', $today)
            ->whereDate('leagurEnddate', '>=', $today)
            ->orderBy('leagurStartdate', 'asc')
            ->first();
    
        if (!$activeleague) {
            // If no league is active today, get the next upcoming league
            $activeleague = League::whereDate('leagurStartdate', '>', $today)
                ->orderBy('leagurStartdate', 'asc')
                ->first();
        }*/
        
        // 1. Get active league
        $activeleague = League::whereDate('leagurStartdate', '<=', $today)
            ->whereDate('leagurEnddate', '>=', $today)
            ->orderBy('leagurStartdate', 'asc')
            ->first();
        
        // 2. Get next upcoming league
        $nextleague = League::whereDate('leagurStartdate', '>', $today)
            ->orderBy('leagurStartdate', 'asc')
            ->first();
        
        // 3. Get last finished league (if no active league found)
        $lastleague = null;
        if (!$activeleague) {
            $lastleague = League::whereDate('leagurEnddate', '<', $today)
                ->orderBy('leagurEnddate', 'desc')
                ->first();
        }
        
        // Decide what to show
        if ($activeleague) {
            $showLeague = $activeleague;   // Active takes priority
        } elseif ($nextleague) {
            $showLeague = $nextleague;     // Next if exists
        } else {
            $showLeague = $lastleague;     // Fallback to last
        }
        
        /*Account Type*/
        $accounttypeval = DB::table('account_types')
                ->where('account_types.ac_index', $showLeague->Mt5groupid)
                ->first();
        
        $liveaccountData = DB::table('tournament_liveaccount as tourlive')
            ->join('users as u', 'u.email', '=', 'tourlive.email')
            ->join('countries as c', 'c.id', '=', 'u.nationalities')
            ->join('account_types as accty', 'accty.ac_index', '=', 'tourlive.account_type')
            ->where('tourlive.tournament_id', $showLeague->id)
            ->where('tourlive.status', 'active')
            ->select(
				'u.id as userrowid',
                'u.userid as randuser',
                'u.name',
                'u.email as usemail',
                'u.country_code',
                'u.phone',
                'u.profile_image',
                'c.title_en AS country',
                'c.code AS ccode',
                'accty.ac_min_deposit as depositval',
                'tourlive.*'
            )
            ->get()
            ->map(function ($row) {
                $balance = $row->depositval ?? 0;
                $equity  = $row->equity ?? 0;
    
                if ($balance > 0) {
                    $profit = (($equity - $balance) / $balance) * 100;
                } else {
                    $profit = 0;
                }
    
                // prevent negative
                $row->profit_percent = round($profit, 2);
    
                return $row;
            })
            ->sortByDesc('profit_percent')
            ->values(); 
    
        // Assign ranks
        $rank = 1;
        foreach ($liveaccountData as $row) {
            if ($row->profit_percent > 0) {
                $row->rank = $rank;
                $rank++;
            } else {
                $row->rank = null;
            }
        }
		
		//If league is finished, update DB with final rank, profit & prizes
		if ($showLeague && $showLeague->leagurEnddate < $today && $showLeague->price_distribute == 0) {
			// get prize structure for this tournament
			$leaguePrize = Leagueprizes::where('tournament_id', $showLeague->id)->first();
			if($leaguePrize){
				DB::beginTransaction();
				$prizeMapping = collect(json_decode($leaguePrize->prizevalue, true))->pluck('value','rank');

				foreach ($liveaccountData as $rowra) {
					if ($rowra->rank !== null && $rowra->rank <= $leaguePrize->totalprize) {
						$prizeAmount = $prizeMapping[$rowra->rank] ?? 0;
					} else {
						$prizeAmount = 0;
					}
					
					$livaccUp = DB::table('tournament_liveaccount')
						->where('id', $rowra->id)
						->update([
							'prizeReceived' => 1,
							'profitpercentage' => $rowra->profit_percent,
							'rank' => $rowra->rank,
							'prizeAmount' => $prizeAmount,
							'prizedistributeDate' => now(),
						]);
						
					// Update wallet balance				
					$wallet = DB::table('wallets')->where('user_id', $rowra->userrowid)->first();
					if ($wallet) {
						// Update existing record
						$walletUp = DB::table('wallets')
							->where('user_id', $rowra->userrowid)
							->update([
								'reward_balance' => DB::raw('reward_balance + ' . (float)$prizeAmount),
								'updated_at'     => now(),
							]);
					} else {
						// Insert new record
						DB::table('wallets')->insert([
							'user_id'          => $rowra->userrowid,
							'balance'          => 0,
							'reward_balance'   => $prizeAmount,
							'referral_balance' => 0,
							'created_at'       => now(),
							'updated_at'       => now(),
						]);
					}
						
					if($prizeAmount > 0) {
						WalletTransaction::create([
							'user_id' => $rowra->userrowid,
							'from_user_id' => 1,
							'amount' => $prizeAmount,
							'type' => 'credit',
							'description' => 'Seaaion Winning Prize',
						]);
					}
					
					/*// Prepare template variables
					$templateVars = [
						'session' => $id,
						'name'  => $winner->name,
						'rank'  => $rank,
						'prize' => $prizeAmount,
						'deposit' => $winner->depositval,
					];

					// Send using Blade template (instead of raw)
					$this->mailService->sendEmail(
						'stanisamj@gmail.com',         
						'PROFXSPORTSCLUB - ðŸŽ‰ Congratulations! You Won a Prize!', 
						[],                   
						'emails.leaguecongurlations',
						$templateVars
					);*/
				}
				/*League Update*/
				$updateleague = League::where('id', $showLeague->id)
					->update([
						'price_distribute' => 1
					]);
				DB::commit();
			}
		}
		
        // Check if AJAX
        if ($request->ajax()) {
            return view('frontEnd.user.leaderboard-table', compact('liveaccountData'));
        }
		$latestleague = DB::table('leagues')
                ->where('leagurStartdate', '>',now())
                ->first();
        return view("frontEnd.user.leaderboard", compact('pagetitle', 'leaguecatlist', 'liveaccountData', 'showLeague', 'accounttypeval','latestleague'));
    }

    
	public function announcements(Request $request)
    {
        $pagetitle = "Announcements";
		return view("frontEnd.user.announcements", compact('pagetitle'));
    }
	
	public function leaderresult(Request $request)
    {
        $pagetitle = "Leader Result";
		return view("frontEnd.user.resultboard", compact('pagetitle'));
    }
	
	public function profile(Request $request)
    {
         $user = Auth::user();
    $pagetitle = "Profile";

    
    $nationalities = Country::all(); 
       
    return view('frontEnd.user.profile', compact('pagetitle', 'user', 'nationalities'));
    }
	
	public function security(Request $request)
    {
        $pagetitle = "Security";
        $user = Auth::user();
		return view("frontEnd.user.security", compact('pagetitle','user'));
    }

	
	public function referral(Request $request)
    {
        $pagetitle = "Referral";
		return view("frontEnd.user.referral", compact('pagetitle'));
    }
	
	public function referred(Request $request)
    {
        $pagetitle = "Referred";
		$user = Auth::user();
		
		//$topUsers = $user->whereNull('referred_by')->with(['referrals'])->get();
		$topUsers = User::with('referrals')->where('id', $user->id)->get();
		return view("frontEnd.user.referred", compact('pagetitle', 'topUsers'));
    }
	
	public function referredfamily(Request $request)
    {
        $pagetitle = "Referred";
		$user = Auth::user();		
		$topUsers = User::with('referrals')->find(auth()->id());
		return view("frontEnd.user.referredfamily", compact('pagetitle', 'topUsers'));
    }
	
	public function referralearning(Request $request)
    {
        $pagetitle = "Referral Earning";
		$referralBonus = ReferralCommission::where('to_user_id', auth()->id())->SUM('amount') ?? 0.00;
		$earninglist = ReferralCommission::where('to_user_id', auth()->id())->latest()->get();
		return view("frontEnd.user.referralearning", compact('pagetitle', 'referralBonus', 'earninglist'));
    }
	
	public function choosepayment($type)
    {
        $pagetitle = "Payment Options";
		$user = Auth::user();	
		$id = 1;
		$paygateway = Paymentgateway::find($id);
		
		if (!in_array($type, ['register', 'deposit'])) {
			abort(404);
		}
		$amount = 0;
		if($type === 'register'){
			$amount = 25;
		}		
		return view("frontEnd.user.choosepayment", compact('pagetitle', 'paygateway', 'type', 'amount'));
    }
	
	public function enrollment(Request $request)
    {
        $pagetitle = "Enrollment";
		$user = Auth::user();	
		return view("frontEnd.user.enrollment", compact('pagetitle'));
    }
	
	public function withdraw(Request $request)
    {
        $pagetitle = "Withdraw";
		$user = Auth::user();
		$rawBalance = Wallet::where('user_id', auth()->id())->value('balance') ?? 0.00;
		// If balance is less than or equal to 25, show 0, else subtract 25
		$availableWallet = $rawBalance > 25 ? $rawBalance - 25 : 0.00;	
		$walletwithdraw = Walletwithdraw::where('user_id', auth()->id())->get();		
		$withdrawapproval = Walletwithdraw::where('user_id', auth()->id())->where('status', 0)->count();		
		return view("frontEnd.user.withdraw", compact('pagetitle', 'availableWallet', 'walletwithdraw', 'withdrawapproval'));
    }
	
	public function getBankAccounts()
	{
		
		$accounts = Bankdetail::where('user_id', auth()->id())
			->where('status', 1)
			->select('id', 'bank_name', 'account_number')
			->get();

		return response()->json($accounts);
	}

	public function getCryptoWallets()
	{
		$wallets = Cryptowallet::where('user_id', auth()->id())
			->where('status', 1)
			->select('id', 'wallet_name', 'wallet_network')
			->get();

		return response()->json($wallets);
	}
	
	public function withdrawrequest(Request $request)
	{
		$request->validate([
			'withdraw_type'   => 'required|in:Bank,Crypto',
			'withdraw_account'=> 'required|integer',
			'withdraw_amount' => 'required|numeric|min:1',
			//'withdraw_proof'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
		]);

		// Save proof file
		//$proofPath = $request->file('withdraw_proof')->store('withdraw_proofs', 'uploads/walletproof');
		//$proofPath = $request->file('withdraw_proof')->move(public_path('uploads/walletproof'), time().'_'.$request->file('withdraw_proof')->getClientOriginalName());
		//$proofname = time().'_'.$request->file('withdraw_proof');


		// Save to DB
		$requestsubmit = Walletwithdraw::insert([
			'user_id'          => auth()->id(),
			'email'            => auth()->user()->email,
			'wallet_balance'    => $request->wallet_balance,
			'withdraw_type'    => $request->withdraw_type,
			'withdraw_account' => $request->withdraw_account,
			'withdraw_amount'  => $request->withdraw_amount,
			'withdraw_proof'   => '',
			'withdraw_requestdate'   => now(),
			'status'           => 0,
			'created_at'       => now(),
		]);
		return response()->json(['message' => 'Withdraw request submitted successfully!']);
	}
	
	public function transfer(Request $request)
    {
        $pagetitle = "Transactions";
		$user = Auth::user();	
		return view("frontEnd.user.transfer", compact('pagetitle'));
    }
	
	public function getRewardbalance()
	{
		$walletReward = Wallet::where('user_id', auth()->id())
			->select('reward_balance')
			->first();
		return response()->json($walletReward);
	}

	public function getReferralbalance()
	{
		$walletBonus = Wallet::where('user_id', auth()->id())
			->select('referral_balance')
			->first();
		return response()->json($walletBonus);
	}
	
	public function storetransfer(Request $request){
		$request->validate([
			'transfer_type'   => 'required|in:Reward,Referral',
			'transfer_amount' => 'required|numeric|min:1',
		]);
		
		$wallet = Wallet::where('user_id', auth()->id())->first();
		if (!$wallet) {
			return response()->json(['message' => 'Wallet not found'], 404);
		}

		// Check balance based on transfer_type
		if ($request->transfer_type == 'Reward') {
			if ($wallet->reward_balance < $request->transfer_amount) {
				return response()->json(['message' => 'Insufficient reward balance'], 400);
			}
		} elseif ($request->transfer_type == 'Referral') {
			if ($wallet->referral_balance < $request->transfer_amount) {
				return response()->json(['message' => 'Insufficient referral balance'], 400);
			}
		}
		
		$internalsubmit = Internaltransfer::insert([
			'user_id'          => auth()->id(),
			'email'            => auth()->user()->email,
			'available_balance'=> $request->available_balance,
			'transfer_type'    => $request->transfer_type,
			'transfer_amount'  => $request->transfer_amount,
			'transfer_date'    => now(),
			'status'           => 1,
			'created_at'       => now(),
		]);
		
		if($internalsubmit){
			/*Payment Log*/
			$datapaymentlog = [
				"payment_purpose" => 'Internal Transfer',
				"payment_amount" => $request->transfer_amount,
				"payment_type" => $request->transfer_type,
				"payment_reference_id" => rand(000000, 999999),
				"payment_status" => "Transfered",
				"initiated_by" => auth()->user()->email
			];
			$paymentLog = PaymentLog::create($datapaymentlog);
			
			Transactions::create([
				'useremail'         => auth()->user()->email,
				'trans_purpose'     => 'Internal Transfer',
				'trans_amount'      => $request->transfer_amount,
				'trans_currency'    => 'USD',
				'trans_method'      => 'Internal',
				'trans_adminremark' => 'auto approved, amount update the wallet',
				'trans_status'      => 'approved',
				'payment_log_id'    => $paymentLog->id
			]);
			
			// Update wallet balance
			DB::table('wallets')
				->where('user_id', auth()->id())
				->update([
					'balance'    => DB::raw('balance + ' . (float)$request->transfer_amount),
					'updated_at' => now(),
				]);

			// Deduct from correct balance type
			if ($request->transfer_type == 'Reward') {
				DB::table('wallets')
					->where('user_id', auth()->id())
					->update([
						'reward_balance' => DB::raw('reward_balance - ' . (float)$request->transfer_amount),
					]);
			} elseif ($request->transfer_type == 'Referral') {
				DB::table('wallets')
					->where('user_id', auth()->id())
					->update([
						'referral_balance' => DB::raw('referral_balance - ' . (float)$request->transfer_amount),
					]);
			}
			
			WalletTransaction::create([
				'user_id'      => auth()->id(),
				'from_user_id' => auth()->id(),
				'amount'       => $request->transfer_amount,
				'type'         => 'Transfer',
				'description'  => $request->transfer_type . ' transfer to wallet.',
			]);
		}
		return response()->json(['message' => 'Internal transfer submitted successfully!']);		
	}
	
//     public function updateProfile(Request $request)
// {
//     $user = Auth::user(); // get the logged-in user

//     $validator = Validator::make($request->all(), [
//         'name' => 'required|string|max:255',
//         'lastname' => 'required|string|max:255',
//         'phone' => 'required|string|max:20',
//         'nationalities' => 'nullable|string|max:255',
//         'country_code' => 'required|string|max:10',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

//     DB::beginTransaction();
//     try {
//         $updateData = [
//             'name'          => $request->name,
//             'lastname'      => $request->lastname,
//             'phone'         => $request->phone,
//             'nationalities' => $request->nationalities,
//             'country_code'  => $request->country_code,
//         ];

//         // Handle image upload only if file exists
//         if ($request->hasFile('profile_image')) {
//             $file = $request->file('profile_image');
//             $fileName = time() . '_' . $file->getClientOriginalName();

//             $destinationPath = base_path('../uploads/profile_images/');

//             if (!file_exists($destinationPath)) {
//                 mkdir($destinationPath, 0755, true);
//             }

//             $file->move($destinationPath, $fileName);

//             $updateData['profile_image'] = 'uploads/profile_images/' . $fileName;
//         }

//         $user->update($updateData);

//         DB::commit();

//         return redirect()->back()->with('success', 'Profile updated successfully.');
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return redirect()->back()->withErrors(['error' => 'Profile update failed. ' . $e->getMessage()]);
//     }
// }


public function updateProfile(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'name'          => 'required|string|max:255',
        'lastname'      => 'required|string|max:255',
        'phone'         => 'required|string|max:20',
        'nationalities' => 'nullable|string|max:255',
        'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {

        $data = $request->only([
            'name',
            'lastname',
            'phone',
            'nationalities'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../uploads/profile_images/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            // Save path to $data so user updates include photo
            $data['photo'] = 'uploads/profile_images/' . $fileName;
        }

        // Update user
        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'photo_url' => isset($data['photo']) ? asset($data['photo']) : null
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user(); // get the logged-in user

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',
    //         // 'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'phone' => 'required|string|max:20',
    //         'nationalities' => 'nullable|string|max:255',
    //         'country_code' => 'required|string|max:10',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
       

    //     DB::beginTransaction();
    //     try {
            
    //          $imgPath = null;
    //      if ($request->hasFile('profile_image')) {
    //         $file = $request->file('profile_image');
    //         $fileName = time() . '_' . $file->getClientOriginalName();


    //         $destinationPath = base_path('../uploads/profile_images/');


    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0755, true);
    //         }


    //         $file->move($destinationPath, $fileName);


    //         $imgPath = 'uploads/profile_images/' . $fileName;
    //     }
        
       
    //         $user->update([
    //             'name' => $request->name,
    //             'lastname' => $request->lastname,
    //             // 'email' => $request->email,
    //             'phone' => $request->phone,
    //             'nationalities' => $request->nationalities,
    //             'country_code' => $request->country_code,
    //             'profile_image' =>$imgPath,
    //         ]);

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Profile updated successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->withErrors(['error' => 'Profile update failed. ' . $e->getMessage()]);
    //     }
    // }
      public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect()->back()->with('success', 'Password updated successfully');
}

    public function kyc(){
        $pagetitle = "KYC";
        $user = Auth::user();
       
        $kyc = Kyc::where('userid', $user->id)->first();
        
        return view("frontEnd.user.kyc", compact('kyc'));
    }
public function upload_kyc(Request $request)
{
    $request->validate([
        'kyc_type'       => 'required|string',
        'id_front'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'id_back'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'address_type'   => 'required|string',
        'address_proof'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $user = Auth::user();

    // Initialize variables
    $idFrontPath = $idBackPath = $addressProofPath = null;

    // Handle ID Front upload
    if ($request->hasFile('id_front')) {
        $file = $request->file('id_front');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = base_path('../uploads/kyc/front');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);
        $idFrontPath = 'uploads/kyc/front/' . $fileName;
    }

    // Handle ID Back upload
    if ($request->hasFile('id_back')) {
        $file = $request->file('id_back');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = base_path('../uploads/kyc/back');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);
        $idBackPath = 'uploads/kyc/back/' . $fileName; // FIXED: removed extra $
    }

    // Handle Address Proof upload
    if ($request->hasFile('address_proof')) {
        $file = $request->file('address_proof');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = base_path('../uploads/kyc/address_proof');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);
        $addressProofPath = 'uploads/kyc/address_proof/' . $fileName;
    }

    // Insert/Update single record per user
    Kyc::updateOrCreate(
        ['userid' => $user->id],
        [
            'email'            => $user->email,
            'kyc_type'         => $request->kyc_type,
            'kyc_fileidfirst'  => $idFrontPath,
            'kyc_fileidsecond' => $idBackPath,
            'address_type'     => $request->address_type,
            'address_proof'    => $addressProofPath,
            'status'           => 0, // pending
        ]
    );
         $user = Auth::user();
        $user->kyc_status =0;
        $user->save();
    return redirect()->back()->with('success', 'KYC submitted successfully. Please wait for approval.');
}

    // public function upload_kyc(Request $request)
    // {
    //     $user = Auth::user();
    //     $user->kyc_status = 0;
    //     $user->save();
        
    //     $kyc = new Kyc();
    //     $kyc->userid = $user->id;
    //     $kyc->email = $user->email;
        
    //     $kycDocumentPath = null;
    //     $kycDocumentPathback = null;
    //     if($request->typedocument == 'idproof'){
            
    //         $existing = Kyc::where('userid', $user->id)->where('typedocument', 'idproof')->orderby('id', 'desc')->first();
    //         if ($existing) {
    //             // if you store file paths, delete the files too
    //             /*if ($existing->kyc_fileidfirst && Storage::exists($existing->kyc_fileidfirst)) {
    //                 Storage::delete($existing->kyc_fileidfirst);
    //             }
    //             if ($existing->kyc_fileidsecond && Storage::exists($existing->kyc_fileidsecond)) {
    //                 Storage::delete($existing->kyc_fileidsecond);
    //             }*/
    //             $existing->delete();
    //         }
            
            
    //         $validator = Validator::make($request->all(), [
    //             'kyc_type' => 'required|string|max:100',
    //             'kyc_fileidfirst' => 'required|file|mimes:jpg,jpeg,png,pdf',
    //             'kyc_fileidsecond' => 'required|file|mimes:jpg,jpeg,png,pdf'
    //         ]);
            
    //         if ($validator->fails()) {
    //             return back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }
            
    //         if ($request->hasFile('kyc_fileidfirst')) {
    //             $file = $request->file('kyc_fileidfirst');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $destinationPath = base_path('../uploads/kyc/front');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0755, true);
    //             }
    //             $file->move($destinationPath, $fileName);
    //             $kycDocumentPath = 'uploads/kyc/front/' . $fileName;
    //         }
            
    //         if ($request->hasFile('kyc_fileidsecond')) {
    //             $file = $request->file('kyc_fileidsecond');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $destinationPath = base_path('../uploads/kyc/back');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0755, true);
    //             }
    //             $file->move($destinationPath, $fileName);
    //             $kycDocumentPathback = 'uploads/kyc/back/' . $fileName;
    //         }
            
    //         $kyc->typedocument = $request->typedocument;
    //         $kyc->kyc_type = $request->kyc_type;
    //         $kyc->kyc_fileidfirst = $kycDocumentPath;
    //         $kyc->kyc_fileidsecond = $kycDocumentPathback;
    //         $kyc->address_proof = '';
    //         $kyc->status = 0 ;
    //     }
        
    //     if($request->typedocument == 'addressproof'){
        
    //         $validator = Validator::make($request->all(), [
    //             'kyc_type' => 'required|string|max:100',
    //             'kyc_file_single' => 'required|file|mimes:jpg,jpeg,png,pdf',
    //             'address_proof' => 'required|file|mimes:jpg,jpeg,png,pdf'
    //         ]);
            
    //         if ($validator->fails()) {
    //             return back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }
            
    //         $existing = Kyc::where('userid', $user->id)->where('typedocument', 'addressproof')->orderby('id', 'desc')->first();
    //         if ($existing) {
    //             // if you store file paths, delete the files too
    //             /*if ($existing->kyc_fileidfirst && Storage::exists($existing->kyc_fileidfirst)) {
    //                 Storage::delete($existing->kyc_fileidfirst);
    //             }
    //             if ($existing->address_proof && Storage::exists($existing->address_proof)) {
    //                 Storage::delete($existing->address_proof);
    //             }*/
    //             $existing->delete();
    //         }
            
    //         if ($request->hasFile('kyc_file_single')) {
    //             $file = $request->file('kyc_file_single');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $destinationPath = base_path('../uploads/kyc/front');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0755, true);
    //             }
    //             $file->move($destinationPath, $fileName);
    //             $kycDocumentPath = 'uploads/kyc/front/' . $fileName;
    //         }
            
    //         if ($request->hasFile('address_proof')) {
    //             $file = $request->file('address_proof');
    //             $fileName = time() . '_' . $file->getClientOriginalName();
    //             $destinationPath = base_path('../uploads/kyc/address_proof');
    //             if (!file_exists($destinationPath)) {
    //                 mkdir($destinationPath, 0755, true);
    //             }
    //             $file->move($destinationPath, $fileName);
    //             $address_proof = 'uploads/kyc/address_proof/' . $fileName;
    //         }
            
    //         $kyc->typedocument = $request->typedocument;
    //         $kyc->kyc_type = $request->kyc_type;
    //         $kyc->kyc_fileidfirst = $kycDocumentPath;
    //         $kyc->kyc_fileidsecond = '';
    //         $kyc->address_proof = $address_proof;
    //         $kyc->status = 0; 
    //     }
    //     $kyc->save();
    //     return back()->with('success', 'KYC document uploaded successfully and is under review.');
    // }
    public function reg_certificate(){
        $user = Auth::user();
        $pagetitle = "Registration Certificate";
        return view("frontEnd.user.reg_certificate", compact('pagetitle','user'));
    }
    public function downloadCertificate($id)
{
    $league = League::findOrFail($id);
    $user = Auth::user();
    
    $rankdata = DB::table('tournament_liveaccount')->where('tournament_id',$league->id)->where('email',$user->email)->first();
  

    
    $templatePath = base_path('../' . $league->league_certificate);
    
    //   echo'<pre>';print_r($templatePath );exit;

    $pdf = new Fpdi();
    $pdf->AddPage('L');
    $pdf->setSourceFile($templatePath);
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx, 0, 0, 297, 210);
    
    
    $pdf->SetFont('Helvetica', 'B', 24);
    $pdf->SetTextColor(0, 0, 0);
    
    
    $pdf->SetXY(0, 103); 
    $pdf->Cell(297, 10, ucfirst($user->name), 0, 0, 'C');
    
    
    $pdf->SetFont('Helvetica', 'B', 18);
    $pdf->SetXY(255, 103); 
    $pdf->Cell(40, 10, $rankdata->rank ?? '0', 0, 0, 'L');
    
    
    $pdf->SetFont('Helvetica', '', 14);
    

    $pdf->SetFont('Helvetica', 'B', 18);
    $pdf->SetXY(135, 123);
    $pdf->Cell(0, 0, Carbon::parse($league->leagurStartdate)->format('d M Y'), 0, 0, 'L');
    
    
    $pdf->SetFont('Helvetica', 'B', 18);
    $pdf->SetXY(225, 124);
    $pdf->Cell(0, 0, Carbon::parse($league->leagurEnddate)->format('d M Y'), 0, 0, 'L');

    // Optional organizer name / footer
    // $pdf->SetFont('Helvetica', '', 12);
    // $pdf->SetXY(0, 185);
    // $pdf->Cell(297, 10, 'ProFX Media LLC', 0, 0, 'C');

    
    return response($pdf->Output('S'), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="League-Certificate-'.$user->name.'.pdf"');
}


     public function acceptDisclaimer(Request $request)
    {
        // echo "test"; exit();
        $user = Auth::user();
        $user->disclaimer_status = 1;
        // dd($user->disclaimer_status);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Disclaimer accepted.']);
    }
    
    
     public function bankstore(Request $request)
    {
        // $request->validate([
        //     'bank_name'       => 'required|string|max:255',
        //     'account_holder'  => 'required|string|max:255',
        //     'account_number'  => 'required|string|max:255',
        //     'ifsccode'            => 'required|string|max:255',
        //     'swift_code'      => 'nullable|string|max:255',
        // ]);

        $userId = auth()->id();

            $bank = new BankDetail();
            $bank->user_id = $userId;
            $bank->bank_name = $request->bank_name;
            $bank->account_number = $request->account_number;
            $bank->account_holder = $request->account_holder;
            $bank->ifsccode = $request->ifsccode;
            $bank->swift_code = $request->swift_code;

            // If no bank exists for this user, make it default
            $existingBank = BankDetail::where('user_id', $userId)->count();
            $bank->isdefault = $existingBank == 0 ? true : false;

            $bank->save();

        return redirect()->back()->with('success', 'Bank detail added successfully!');
    }
            
    /**
     * Update bank detail
     */
    public function bankupdate(Request $request, $id)
    {
        $request->validate([
            'bank_name'       => 'required|string|max:255',
            'account_holder'  => 'required|string|max:255',
            'account_number'  => 'required|string|max:255',
            'ifsccode'            => 'required|string|max:255',
            'swift_code'      => 'nullable|string|max:255',
        ]);

        $bank = BankDetail::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $bank->update([
            'bank_name'      => $request->bank_name,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'ifsccode'           => $request->ifsccode,
            'swift_code'     => $request->swift_code,
        ]);

        return redirect()->back()->with('success', 'Bank detail updated successfully!');
    }

    /**
     * Delete bank detail
     */
    public function bankdestroy($id)
    {
        $bank = BankDetail::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $bank->delete();

        return redirect()->back()->with('success', 'Bank detail deleted successfully!');
    }
    
    /*League Function here*/	
	public function listleague(Request $request){
		$today = date('Y-m-d');	
		$userId = Auth::id();
		$enrolledLeagueIds = Enrollment::where('userid', $userId)->pluck('leaguecatid')->toArray();
		
		$leaguesquery = Categorie::where('status', 1)->where('parent_id', '!=', 0)->whereNotIn('id', $enrolledLeagueIds);		
		if ($request->listing == 'active') {
			$pagetitle = 'Active League';
			$listtype = "active";
			$leaguesquery->where('registerstartDate', '<=', $today)
						 ->where('eventstartDate', '>=', $today);
		} elseif ($request->listing == 'upcoming') {
			$pagetitle = 'Upcoming League';
			$listtype = "upcoming";	
			$leaguesquery->where('registerstartDate', '>', $today);

		} elseif ($request->listing == 'expired') {
			$pagetitle = 'Expired League';
			$listtype = "expire";
			$leaguesquery->where('eventstartDate', '<', $today);

		} else {
			$pagetitle = 'League List';
		}
		
		$leagueslist = $leaguesquery->orderBy('eventstartDate', 'asc')->get();
		
// 		echo'<pre>';print_r($leagueslist);exit;
		return view("frontEnd.user.leaguelist", compact('pagetitle', 'leagueslist', 'listtype'));		
	}
	
	public function enrollleague(Request $request){
		// Validate request
        $request->validate([
            'leaguecatid' => 'required|exists:categories,id'
        ]);

        // Example logic: store enrollment
        Enrollment::create([
            'userid' => auth()->id(),
            'leaguecatid' => $request->leaguecatid,
			'enrolleddate' => now(),
			'status' => 1,
			'created_at' => now(),
			'updated_at' => now()
        ]);
        return response()->json(['success' => true, 'message' => 'Enrolled successfully']);
	}
	
	public function myleague(Request $request){
		$pagetitle = 'League List';
		$userId = Auth::id();
		$user = Auth::user();
		$enrolledLeagueIds = Enrollment::where('userid', $userId)->pluck('leaguecatid')->toArray();
		
		if(!empty($enrolledLeagueIds)){
		    $enids = implode(',', $enrolledLeagueIds);
    		$leaguelist = DB::select("
    			SELECT 
    				l.*,
    				CASE 
    					WHEN tla.tournament_id IS NOT NULL THEN 1 
    					ELSE 0 
    				END AS received_flag,
    				tla.id as liveid,
    				tla.tournament_id as tournament_id,
    				tla.trade_id as trade_id,
    				tla.trader_pwd as trader_pwd,
    				tla.invester_pwd as invester_pwd,
    				tla.Balance as Balance,
    				tla.equity as equity,
    				tla.profitpercentage as profitpercentage,
    				tla.rank as rank,
    				tla.prizeAmount as prizeAmount,
    				tla.prizeReceived as prizeReceived,
    				tla.prizedistributeDate as prizedistributeDate,
    				tla.leverage as leverage,
    				mt5acc.company_title,
    				acctype.ac_min_deposit
    			FROM smartend_leagues l
    			LEFT JOIN smartend_tournament_liveaccount tla 
    				   ON tla.tournament_id = l.id
    				   AND tla.email = '".$user->email."'
    			LEFT JOIN smartend_mt5_accounts mt5acc
    			      ON mt5acc.id = l.mt5_server_id
    			LEFT JOIN smartend_account_types acctype
    			      ON acctype.ac_index = tla.account_type
    			WHERE l.subcategoryid IN ($enids)
    			  AND l.status = 1
    			ORDER BY l.id DESC
    		");
    		$leaguelist = collect($leaguelist);
    	
		} else {
		    $leaguelist = []; 
		}
		
		$platformsettings = Configsetting::pluck('value', 'name')->toArray();
		return view("frontEnd.user.myleague", compact('pagetitle', 'enrolledLeagueIds', 'leaguelist', 'platformsettings'));	
	}
	
	public function myresult(Request $request){
	    $pagetitle = 'My Results';
	    return view("frontEnd.user.myresult", compact('pagetitle'));	
	}

	
}
