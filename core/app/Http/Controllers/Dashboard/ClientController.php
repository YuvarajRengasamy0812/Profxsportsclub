<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Configsetting;
use App\Models\WebmasterSection;
use App\Models\User;
use App\Models\Wallet;
use App\Models\account_type;
use App\Models\WalletTransaction;
use App\Models\Country;
use App\Models\Bankdetail;
use App\Models\Cryptowallet;
use App\Models\League;
use App\Models\Team;
use App\Models\Player;
use App\Models\AdminTeam;
use App\Models\Travel;
use App\Models\TravelPlayer;
use App\Models\AdminTravel;
use App\Models\AdminNetwork;
use App\Models\Walletwithdraw;
use App\Models\TournamentLiveAccount as LiveAccount;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use Helper;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Services\MailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use App\Services\CertificateService;
use App\Models\Booking;
use App\Models\Membership;
use App\Models\Payment;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ClientController extends Controller
{
    private $uploadPath = "uploads/settings/";
	protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->middleware('auth');
		$this->mailService = $mailService;
    }
	
// 	public function clientlist(Request $request, CertificateService $certificateService){
// 		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
// 		$exporttitle = 'All';
// 		$userquery = User::select('users.*', 'c.title_en as country', 'c.code as flagcode')
//         ->leftJoin('countries as c', 'c.id', '=', 'users.nationalities')
//         ->where('user_type', 2);
// 		if ($request->has('payment_status')) {
// 			$userquery->where('payment_status', $request->payment_status);
// 			$exporttitle = "Payment";
// 		}
// 		if ($request->has('kyc_status')) {
// 			$userquery->where('kyc_status', $request->kyc_status);
// 			$exporttitle = "KYC";
// 		}
// 		if ($request->has('email_verified_at')) {
// 			if ($request->email_verified_at === 'null') {
// 				$userquery->whereNull('email_verified_at');
// 			} elseif ($request->email_verified_at === 'notnull') {
// 				$userquery->whereNotNull('email_verified_at');
// 			}
// 			$exporttitle = "Email";
// 		}
		
// 		    if ($request->filled('email')) {
//                 $query->where('email', 'like', '%' . $request->email . '%');
//             }
        
//             if ($request->filled('mobile')) {
//                 $query->where('mobile', 'like', '%' . $request->mobile . '%');
//             }
        
//             if ($request->filled('country')) {
//                 $query->where('country', 'like', '%' . $request->country . '%');
//             }
		
// 		if ($request->has('export') && $request->export === 'csv') {
//             $users = $userquery->get();
    
//             $filename = "users_export_".$exporttitle."_". date('Y-m-d_H-i-s') . ".csv";
    
//             $headers = [
//                 "Content-type"        => "text/csv",
//                 "Content-Disposition" => "attachment; filename=$filename",
//                 "Pragma"              => "no-cache",
//                 "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
//                 "Expires"             => "0"
//             ];
    
//             $columns = ['ID', 'Name', 'Email', 'Country', 'Payment Status', 'KYC Status', 'Email Verified At'];
    
//             $callback = function() use ($users, $columns) {
//                 $file = fopen('php://output', 'w');
//                 fputcsv($file, $columns);
    
//                 foreach ($users as $user) {
//                     fputcsv($file, [
//                         $user->id,
//                         $user->name,
//                         $user->email,
// 						$user->country ?? 'N/A',
//                         $user->payment_status,
//                         $user->kyc_status,
//                         $user->email_verified_at ?? 'Not Verified',
//                     ]);
//                 }
//                 fclose($file);
//             };
    
//             return Response::stream($callback, 200, $headers);
//         }		
// 		$Users = $userquery->orderBy('id', 'desc')->paginate(config('smartend.backend_pagination'))->appends(request()->query());
		
// 		$stats = User::selectRaw("
//             COUNT(*) as totalCount,
//             SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as paymentCount,
//             SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as paymentNotCount,
//             SUM(CASE WHEN kyc_status = 1 THEN 1 ELSE 0 END) as kycCount,
//             SUM(CASE WHEN kyc_status = 0 THEN 1 ELSE 0 END) as kycNotCount,
// 			SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as emailCount,
// 			SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as emailNotCount
//         ")
//         ->where('user_type', 2)
//         ->first();
        
        
//         /*$usercert = User::where('id', 31)->orderBy('id', 'asc')->get();
//         foreach($usercert as $usercert){
//             $certificatePath = $certificateService->generateCertificate($usercert->name, date('d-m-Y', strtotime($usercert->created_at)));
//             $file_path ="https://profxleague.com/".$certificatePath;
//             $usercert->update([
//                 'certificate_path' => $certificatePath
//             ]);
//         }*/
        
// 		return view("dashboard.clients.list", compact('GeneralWebmasterSections', 'Users', 'stats'));		
// 	}
	public function clientlist(Request $request, CertificateService $certificateService)
{
    $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';

    // Base query
    $userquery = User::select('users.*', 'c.title_en as country', 'c.code as flagcode')
        ->leftJoin('countries as c', 'c.id', '=', 'users.nationalities')
        ->where('user_type', 2);

    // Filters
    if ($request->has('payment_status')) {
        $userquery->where('payment_status', $request->payment_status);
        $exporttitle = "Payment";
    }

    if ($request->has('kyc_status')) {
        $userquery->where('kyc_status', $request->kyc_status);
        $exporttitle = "KYC";
    }

    if ($request->has('email_verified_at')) {
        if ($request->email_verified_at === 'null') {
            $userquery->whereNull('email_verified_at');
        } elseif ($request->email_verified_at === 'notnull') {
            $userquery->whereNotNull('email_verified_at');
        }
        $exporttitle = "Email";
    }

    // Search filters
    if ($request->filled('email')) {
        $userquery->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('mobile')) {
        $userquery->where('phone', 'like', '%' . $request->mobile . '%');
    }

    if ($request->filled('country')) {
        $userquery->where('nationalities', 'like', '%' . $request->country . '%'); // Use joined country
    }

    // CSV Export
    if ($request->has('export') && $request->export === 'csv') {
        $users = $userquery->get();

        $filename = "users_export_{$exporttitle}_" . date('Y-m-d_H-i-s') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Name', 'Email', 'Country', 'Payment Status', 'KYC Status', 'Email Verified At'];

        $callback = function() use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->country ?? 'N/A',
                    $user->payment_status,
                    $user->kyc_status,
                    $user->email_verified_at ?? 'Not Verified',
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    // Pagination with query string
    $Users = $userquery->orderBy('id', 'desc')
        ->paginate(config('smartend.backend_pagination'))
        ->appends($request->query());

    // Stats
    $stats = User::selectRaw("
        COUNT(*) as totalCount,
        SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as paymentCount,
        SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as paymentNotCount,
        SUM(CASE WHEN kyc_status = 1 THEN 1 ELSE 0 END) as kycCount,
        SUM(CASE WHEN kyc_status = 0 THEN 1 ELSE 0 END) as kycNotCount,
        SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as emailCount,
        SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as emailNotCount
    ")
    ->where('user_type', 2)
    ->first();
    
    $nationalcoutry = Country::all();

    return view("dashboard.clients.list", compact('GeneralWebmasterSections', 'Users', 'stats', 'nationalcoutry'));        
}

	public function clientcreate()
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $nationalities = Country::all();
        return view("dashboard.clients.create", compact("GeneralWebmasterSections", 'nationalities'));
    }
	
	protected function clientregister(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
			'referral_code' => 'nullable|exists:users,referral_code',
			'contact_phone' => 'required|string|max:20',
			'nationalities' => 'nullable|string|max:255',
		], [
			'email.unique' => 'This email is already registered.',
			'referral_code.exists' => 'Referral code is invalid.',
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		DB::beginTransaction();
		try {
			$user = User::create([
				'name'              => $request->firstname,
				'email'             => $request->email,
				'phone'             => $request->contact_phone,
				'nationalities'     => $request->nationalities,
				'referred_by'       => $request->referral_code,
				'wallet_amount'     => 0,
				'password'          => Hash::make($request->password),
                'real_password'     => $request->password,
				'status'            => true,
				'user_type'         => 2,
				'country_code'      => $request->country_code,
				'permissions_id'    => Helper::GeneralWebmasterSettings("permission_group"),
			]);

            $verificationLink = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );
            
            $templateVars = [
                'name'             => $user->name,
                'server_name'      => 'PROFXSPORTSCLUB',
                'site_link'        => 'https://profxleague.com',
                'email'            => $user->email,
                'verificationUrl'  => $verificationLink,
            ];
            
            $this->mailService->sendEmail(
                $user->email,         // recipient
                'PROFXSPORTSCLUB - Email Verification!', // subject
                [],                   // headers (ignored)
                'emails.account_verification',      // <- use the Blade template here
                $templateVars         // variables for template
            );
			DB::commit();
			return redirect()->route('clientlist')->with('doneMessage', 'The client has been added successfully. A verification email has been sent to the registered address.');
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->withErrors(['error' => 'Registration failed. ' . $e->getMessage()]);
		}
	}
	
	
	public function resendVerification($id)
    {
        DB::beginTransaction();

    
            $user = User::findOrFail($id);
 
            if ($user->email_verified_at) {
                return back()->with('success', 'User is already verified.');
            }

            // Generate Laravel signed verification link valid for 60 minutes
            $verificationLink = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );
            
            $user->update([
                'resendemail_date' => now(),
            ]);
            $templateVars = [
                'name'             => $user->name,
                'server_name'      => 'PROFXSPORTSCLUB',
                'site_link'        => 'https://profxleague.com',
                'email'            => $user->email,
                'verificationUrl'  => $verificationLink,
            ];

            $this->mailService->sendEmail(
                $user->email,
                'PROFXSPORTSCLUB - Email Verification!',
                [], // headers (ignored in your mail service)
                'emails.account_verification',
                $templateVars
            );

            DB::commit();

            return response()->json([
        'status' => 'success',
        'message' => 'Verification email sent successfully.'
    ]);
    }
    
    public function clientedit($id)
    {
		$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $nationalities = Country::all();
        $Users = User::find($id);
        return view("dashboard.clients.edit", compact("GeneralWebmasterSections", 'nationalities', 'Users'));
    }
    
    public function clientupdate(Request $request, $id)
    {
        $User = User::find($id);
        if (!empty($User)) {
            $User->name     = $request->firstname;
			$User->phone    = $request->contact_phone;
			$User->nationalities = $request->nationalities;
			$User->referred_by = $request->referral_code;
			$User->country_code = $request->country_code;
            $User->role = $request->role;
			$User->save();			
        }
        return redirect()->route('clientlist')->with('doneMessage', 'The user details has been updated successfully.');
    }
    
	/*Bank Details*/
	public function banklist(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$Banks = Bankdetail::join('users', 'users.id', '=', 'bankdetails.user_id')->orderby('bankdetails.id', 'desc')->paginate(config('smartend.backend_pagination'));
		return view("dashboard.clients.banklist", compact('GeneralWebmasterSections', 'Banks'));		
	}
	public function walletlist()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', 1)
            ->orderby('row_no', 'asc')
            ->get();
    
        $wallets = Cryptowallet::join('users', 'users.id', '=', 'cryptowallets.user_id')
            ->select('cryptowallets.*', 'users.name', 'users.email') // select needed fields
            ->orderby('cryptowallets.id', 'desc')
            ->paginate(config('smartend.backend_pagination'));
    
        return view("dashboard.clients.walletlist", compact('GeneralWebmasterSections', 'wallets'));
    }
    
    /*Leader User list*/
	public function leaderuserlist(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$exporttitle = 'All';
		$userquery = User::select('users.*', 'c.title_en as country', 'c.code as flagcode')
        ->leftJoin('countries as c', 'c.id', '=', 'users.nationalities')
        ->where('user_type', 5);
		if ($request->has('payment_status')) {
			$userquery->where('payment_status', $request->payment_status);
			$exporttitle = "Payment";
		}
		if ($request->has('kyc_status')) {
			$userquery->where('kyc_status', $request->kyc_status);
			$exporttitle = "KYC";
		}
		if ($request->has('email_verified_at')) {
			if ($request->email_verified_at === 'null') {
				$userquery->whereNull('email_verified_at');
			} elseif ($request->email_verified_at === 'notnull') {
				$userquery->whereNotNull('email_verified_at');
			}
			$exporttitle = "Email";
		}
		
		if ($request->has('export') && $request->export === 'csv') {
            $users = $userquery->get();
    
            $filename = "users_export_".$exporttitle."_". date('Y-m-d_H-i-s') . ".csv";
    
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];
    
            $columns = ['ID', 'Name', 'Email', 'Country', 'Payment Status', 'KYC Status', 'Email Verified At'];
    
            $callback = function() use ($users, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
    
                foreach ($users as $user) {
                    fputcsv($file, [
                        $user->id,
                        $user->name,
                        $user->email,
						$user->country ?? 'N/A',
                        $user->payment_status,
                        $user->kyc_status,
                        $user->email_verified_at ?? 'Not Verified',
                    ]);
                }
                fclose($file);
            };
    
            return Response::stream($callback, 200, $headers);
        }		
		$Users = $userquery->orderBy('id', 'desc')->paginate(config('smartend.backend_pagination'));
		
		$stats = User::selectRaw("
            COUNT(*) as totalCount,
            SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as paymentCount,
            SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as paymentNotCount,
            SUM(CASE WHEN kyc_status = 1 THEN 1 ELSE 0 END) as kycCount,
            SUM(CASE WHEN kyc_status = 0 THEN 1 ELSE 0 END) as kycNotCount,
			SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as emailCount,
			SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as emailNotCount
        ")
        ->where('user_type', 5)
        ->first();
        
		return view("dashboard.leaderusers.list", compact('GeneralWebmasterSections', 'Users', 'stats'));		
	}
	
	public function leaderusercreate()
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $nationalities = Country::all();
        return view("dashboard.leaderusers.create", compact("GeneralWebmasterSections", 'nationalities'));
    }
	
	protected function leaderuserregister(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',			
			'referral_code' => 'nullable|exists:users,referral_code',
			'contact_phone' => 'required|string|max:20',
			'nationalities' => 'nullable|string|max:255',
		], [
			'email.unique' => 'This email is already registered.',
			'referral_code.exists' => 'Referral code is invalid.',
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		
		$imagePath = '';
		if ($request->hasFile('profile_image')) {
			$file = $request->file('profile_image');
			$fileName = time() . '_' . $file->getClientOriginalName();
			$destinationPath = base_path('../uploads/users');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0755, true);
			}
			$file->move($destinationPath, $fileName);
			$imagePath = 'uploads/users/' . $fileName;
		}

		DB::beginTransaction();
		try {
			$user = User::create([
				'name'              => $request->firstname,
				'email'             => $request->email,
				'phone'             => $request->contact_phone,
				'nationalities'     => $request->nationalities,
				'referred_by'       => '',
				'wallet_amount'     => 0,
				'password'          => Hash::make('Profx@1234'),
                'real_password'     => 'Profx@1234',
				'status'            => true,
				'user_type'         => 5,
				'payment_status'    => 1,
				'country_code'      => $request->country_code,
				'permissions_id'    => Helper::GeneralWebmasterSettings("permission_group"),
				'email_verified_at' => now(),
				'profile_image'     => $imagePath,
			]);
			$user->update([
				'userid' => 'PROFX' . (10000 + $user->id),
			]);
			DB::commit();
			return redirect()->route('leaderuserlist')->with('doneMessage', 'The client has been added successfully.');
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->withErrors(['error' => 'Registration failed. ' . $e->getMessage()]);
		}
	}
	
	public function leaderuseredit($id)
    {   
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();        
        $Users = User::find($id);
		$nationalities = Country::all();
        return view("dashboard.leaderusers.edit", compact("Users", "GeneralWebmasterSections", 'nationalities'));
    }
	
	public function leaderuserupdate(Request $request, $id)
    {        
        $User = User::find($id);
        if (!empty($User)) {
            try {
                $validator = Validator::make($request->all(), [
					'firstname' => 'required|string|max:255',
					'email' => 'required|string|email|max:255',			
					'referral_code' => 'nullable|exists:users,referral_code',
					'contact_phone' => 'required|string|max:20',
					'nationalities' => 'nullable|string|max:255',
				], [
					'email.unique' => 'This email is already registered.',
					'referral_code.exists' => 'Referral code is invalid.',
				]);

				if ($validator->fails()) {
					return redirect()->back()
						->withErrors($validator)
						->withInput();
				}
				
				$imagePath = '';
				if ($request->hasFile('profile_image') != "") {
					$file = $request->file('profile_image');
					$fileName = time() . '_' . $file->getClientOriginalName();
					$destinationPath = base_path('../uploads/users');
					if (!file_exists($destinationPath)) {
						mkdir($destinationPath, 0755, true);
					}
					$file->move($destinationPath, $fileName);
					$imagePath = 'uploads/users/' . $fileName;
				} else {
					$imagePath = $request->profile_image_hidden;
				}
				$User->name     = $request->firstname;
				$User->email    = $request->email;
				$User->phone    = $request->contact_phone;
				$User->nationalities = $request->nationalities;
				$User->profile_image = $imagePath;
				$User->save();				
				
                return redirect()->route('leaderuserlist')->with('doneMessage', 'The client has been updated successfully.');
            } catch (\Exception $e) {

            }
        }
    }
    
    /*Account Management*/	
	public function touraccountlist(Request $request){
		
// 		$today = Carbon::today()->toDateString();
// 		// 1. Get active league
//         $activeleague = League::whereDate('leagurStartdate', '<=', $today)
//             ->whereDate('leagurEnddate', '>=', $today)
//             ->orderBy('leagurStartdate', 'asc')
//             ->first();
        
//         // 2. Get next upcoming league
//         $nextleague = League::whereDate('leagurStartdate', '>', $today)
//             ->orderBy('leagurStartdate', 'asc')
//             ->first();
        
//         // 3. Get last finished league (if no active league found)
//         $lastleague = null;
//         if (!$activeleague) {
//             $lastleague = League::whereDate('leagurEnddate', '<', $today)
//                 ->orderBy('leagurEnddate', 'desc')
//                 ->first();
//         }
        
//         // Decide what to show
//         if ($activeleague) {
//             $showLeague = $activeleague;   // Active takes priority
//         } elseif ($nextleague) {
//             $showLeague = $nextleague;     // Next if exists
//         } else {
//             $showLeague = $lastleague;     // Fallback to last
//         }
        
//         /*Account Type*/
//         $accounttypeval = DB::table('account_types')
//                 ->where('account_types.ac_index', $showLeague->Mt5groupid)
//                 ->first();
        
//         $liveaccountData = DB::table('tournament_liveaccount as tourlive')
//             ->join('users as u', 'u.email', '=', 'tourlive.email')
//             ->join('countries as c', 'c.id', '=', 'u.nationalities')
//             ->join('account_types as accty', 'accty.ac_index', '=', 'tourlive.account_type')
//             ->where('tourlive.tournament_id', $showLeague->id)
//             ->select(
//                 'u.userid as randuser',
//                 'u.name',
//                 'u.email as usemail',
//                 'u.country_code',
//                 'u.phone',
//                 'u.profile_image',
//                 'c.title_en AS country',
//                 'c.code AS ccode',
//                 'accty.ac_min_deposit as depositval',
//                 'accty.ac_group',
//                 'tourlive.*'
//             )
//             ->get()
//             ->map(function ($row) {
//                 $balance = $row->depositval ?? 0;
//                 $equity  = $row->equity ?? 0;
    
//                 if ($balance > 0) {
//                     $profit = (($equity - $balance) / $balance) * 100;
//                 } else {
//                     $profit = 0;
//                 }
    
//                 // prevent negative
//                 $row->profit_percent = round($profit, 2);
    
//                 return $row;
//             })
//             ->sortByDesc('profit_percent')
//             ->values(); 
   
//         // Assign ranks
//         $rank = 1;
//         foreach ($liveaccountData as $row) {
//             if ($row->profit_percent > 0) {
//                 $row->rank = $rank;
//                 $rank++;
//             } else {
//                 $row->rank = null;
//             }
//         }
        
 $allLeagues = League::orderBy('leagurStartdate', 'desc')->get();

    $liveaccountData = collect();

    foreach ($allLeagues as $league) {

        // Get all accounts for this league
        $leagueAccounts = DB::table('tournament_liveaccount as tourlive')
            ->join('users as u', 'u.email', '=', 'tourlive.email')
            ->join('countries as c', 'c.id', '=', 'u.nationalities')
            ->join('account_types as accty', 'accty.ac_index', '=', 'tourlive.account_type')
            ->where('tourlive.tournament_id', $league->id)
            ->select(
                'u.userid as randuser',
                'u.name',
                'u.email as usemail',
                'u.country_code',
                'u.phone',
                'u.profile_image',
                'c.title_en AS country',
                'c.code AS ccode',
                'accty.ac_min_deposit as depositval',
                'accty.ac_group',
                'tourlive.trade_id',
                'tourlive.Balance',
                'tourlive.equity',
                'tourlive.account_type',
                DB::raw("'" . $league->league_name . "' as league_name"),
                DB::raw("'" . $league->id . "' as league_id")
            )
            ->get()
            ->map(function ($row) {
                $balance = $row->depositval ?? 0;
                $equity  = $row->equity ?? 0;

                $row->profit_percent = ($balance > 0)
                    ? round((($equity - $balance) / $balance) * 100, 2)
                    : 0;

                return $row;
            });

        //  Rank inside this league only
        $sortedLeagueAccounts = $leagueAccounts->sortByDesc('profit_percent')->values();

        $rank = 1;
        foreach ($sortedLeagueAccounts as $row) {
            $row->rank = $row->profit_percent > 0 ? $rank++ : null;
        }

        // Merge with all results (for display)
        $liveaccountData = $liveaccountData->merge($sortedLeagueAccounts);
    }

    // Optional: sort leagues overall by date (not by rank)
    $liveaccountData = $liveaccountData->sortByDesc('league_id')->values();

   

//   echo'<pre>';print_r($liveaccountData);exit;
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.clients.accountlist", compact('GeneralWebmasterSections','liveaccountData'));		
	}
	
	public function clientview($userid){
		$clientdetails = User::whereRaw('md5(userid) = ?', $userid)->first();
		
		
		$transactions = WalletTransaction::with('fromUser')->where('user_id', $clientdetails->id)->latest()->get();
			$wallet = Wallet::where('user_id', $clientdetails->id)
			->select('balance', 'reward_balance', 'referral_balance')
			->first();

		$availableWallet = [
			'balance'         => $wallet->balance ?? 0.00,
			'reward_balance'  => $wallet->reward_balance ?? 0.00,
			'referral_balance'=> $wallet->referral_balance ?? 0.00,
		];
		
		$Users = User::where('userid', $clientdetails->userid)->first();
		
		$walletdetails = Walletwithdraw::whereRaw('MD5(user_id) = ?', [$userid])->get();
		
	  
		$accountcount = LiveAccount::where('email', $Users->email)->count();
		
// 		echo'<pre>';print_r($accountcount );exit;
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.clients.clientdetails", compact('GeneralWebmasterSections','clientdetails','availableWallet','transactions','walletdetails','accountcount'));
	}
	
	public function accountview($tradeid){
		$accountdetails = LiveAccount::whereRaw('md5(trade_id) = ?', $tradeid)->first();
		$leaguedetails = account_type::where('ac_index', $accountdetails->account_type)->first();
		
		$Users = User::where('email',$accountdetails->email)->first();
		
// 	echo'<pre>';print_r($leaguedetails);exit;
		
		$transactions = WalletTransaction::with('fromUser')->where('user_id', $Users->id)->latest()->get();
		
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.clients.accountdetails", compact('GeneralWebmasterSections','accountdetails','transactions','Users','leaguedetails'));
	}
	
	public function bookingList(Request $request)
    {

          $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';
        $query = DB::table('bookings');

        // 🔍 Search filters
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('game')) {
            $query->where('game', 'like', '%' . $request->game . '%');
        }

        // 📤 Export CSV
        if ($request->has('export') && $request->export === 'csv') {
            return $this->exportCsv($query);
        }

        // 📄 Pagination
        $bookings = $query
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        // 📊 Stats
        $stats = (object)[
            'total' => DB::table('bookings')->count(),
        ];

        return view('dashboard.booking.listbooking', compact('GeneralWebmasterSections', 'bookings','stats'));
    }

    // 👁️ View Single Booking
    public function bookingView($id)
    {
                 $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';
        $booking = DB::table('bookings')->where('id', $id)->first();

        abort_if(!$booking, 404);

        return view('dashboard.booking.viewbooking', compact('GeneralWebmasterSections', 'booking'));
    }

    // 📤 CSV Export Function
    private function exportCsv($query)
    {
        $fileName = 'bookings_' . date('Y-m-d_H-i-s') . '.csv';

        return new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($handle, [
                'ID',
                'Name',
                'Email',
                'Game',
                'Sub Game',
                'Phone',
                'Message',
                'Created At'
            ]);

            // Chunk for memory safety
            $query->orderBy('created_at', 'DESC')
                ->chunk(100, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->id,
                            $row->name ?? '',
                            $row->email ?? '',
                            $row->game ?? '',
                            $row->subGame ?? '',
                            $row->phone ?? '',
                            $row->message ?? '',
                            $row->created_at ?? '',
                        ]);
                    }
                });

            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Cache-Control" => "no-cache, no-store, must-revalidate",
            "Pragma" => "no-cache",
            "Expires" => "0",
        ]);
    }
    
    public function corporateList(Request $request)
    {

          $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();
$query = DB::table('corporate_payments')
        ->leftJoin('users', 'corporate_payments.user_id', '=', 'users.id')
        ->select(
            'corporate_payments.*',
            'users.name as user_name',
            'users.email as user_email'
        );

        // 🔍 Search filters
        if ($request->filled('plan_name')) {
            $query->where('plan_name', 'like', '%' . $request->plan_name . '%');
        }

        if ($request->filled('methods')) {
            $query->where('methods', 'like', '%' . $request->methods . '%');
        }

        // 📤 Export CSV
     

        // 📄 Pagination
    $payments = $query
        ->orderBy('corporate_payments.created_at', 'DESC')
        ->paginate(10)
        ->appends($request->query());

        // 📊 Stats
        $stats = (object)[
            'total' => DB::table('corporate_payments')->count(),
        ];

        return view('dashboard.payments.listpayments', compact('GeneralWebmasterSections', 'payments','stats'));
    }
	 public function corporateView($id)
    {
                 $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';
        $payment = DB::table('corporate_payments')->where('id', $id)->first();

        abort_if(!$payment, 404);

        return view('dashboard.payments.viewpayments', compact('GeneralWebmasterSections', 'payment'));
    }
    
// membership

	public function membershipList(Request $request)
    {

          $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';
        $query = DB::table('membership');

        // 🔍 Search filters
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

    

        // 📄 Pagination
        $memberships = $query
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        // 📊 Stats
        $stats = (object)[
            'total' => DB::table('membership')->count(),
        ];

        return view('dashboard.membership.membershipList', compact('GeneralWebmasterSections', 'memberships','stats'));
    }
    
      public function membershipView($id)
    {
                 $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    $exporttitle = 'All';
        $member = DB::table('membership')->where('id', $id)->first();

        abort_if(!$member, 404);

        return view('dashboard.membership.viewmembership', compact('GeneralWebmasterSections', 'member'));
    }



    // temalist


//  public function listtems()
//     {
//         // Get the currently logged-in user ID
// $GeneralWebmasterSections = WebmasterSection::where('status', 1)
//         ->orderby('row_no', 'asc')
//         ->get();
//         // Load only teams belonging to the current user, with players count
//         $teams = Team::withCount('players')
                  
//                     ->latest()
//                     ->get();

//         return view('dashboard.team.listteam', compact('GeneralWebmasterSections','teams'));
//     }

public function temssave(Request $request)
{
    
    $request->validate([
        'team_name' => 'required|string|max:255',
        'category'  => 'required|string|max:255',
        'game'      => 'required|string|max:255',
        'logo'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'players'   => 'required|array|min:1',
        'players.*' => 'required|string|max:255',
    ]);

    // ============================
    // IMAGE UPLOAD (PUBLIC FOLDER)
    // ============================

    $formFileName = 'logo';                 // input name
    $fileFinalName = null;

     if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);

            // resize & optimize
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }
   

    // ============================
    // SAVE TEAM
    // ============================

    $team = Team::create([
         'user_id' => auth()->id(),       // <-- Save authenticated user ID
        'name'   => $request->team_name,
        'logo'   => $fileFinalName, // save RELATIVE PATH
        'sports' => $request->category,
        'game'   => $request->game,
    ]);

    // ============================
    // SAVE PLAYERS
    // ============================

    foreach ($request->players as $playerName) {
        Player::create([
            'team_id' => $team->id,
            'name'    => $playerName,
        ]);
    }

    return redirect()
        ->route('listtems')
        ->with('success', 'Team created successfully!');
}

    /**
     * View single team with players
     */
    // public function teamdetails($id)
    // {
    //     $GeneralWebmasterSections = WebmasterSection::where('status', 1)
    //     ->orderby('row_no', 'asc')
    //     ->get();
        
    //     $team = Team::with('players')->findOrFail($id);

    //     return view('dashboard.team.view', compact('GeneralWebmasterSections','team'));
    // }
    
    
    
         public function listtems()
    {
        // Get the currently logged-in user ID
$GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();
        // Load only teams belonging to the current user, with players count
        $teams = AdminTeam::
                  
                  latest()
                    ->get();

        return view('dashboard.team.listteam', compact('GeneralWebmasterSections','teams'));
    }

        public function teamdetails($id)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();
        
        $team = AdminTeam::with('players')->findOrFail($id);

        return view('dashboard.team.view', compact('GeneralWebmasterSections','team'));
    }
    
    
    
    
    
     public function listtravel()
{
    // Get active webmaster sections
    $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    // Get all travel teams, latest first
    $teams = AdminTravel::latest()->get();

    // Add full image URL for each team if image exists
    foreach ($teams as $team) {
        if (!empty($team->image)) {
            $team->image = url('uploads/topics/' . $team->image);
        } else {
            $team->image = null;
        }
    }

    // Return view with teams and sections
    return view('dashboard.travel.listteam', compact('GeneralWebmasterSections', 'teams'));
}


        public function traveldetails($id)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();
        
        $team = AdminTravel::with('travelplayers')->findOrFail($id);

        return view('dashboard.travel.view', compact('GeneralWebmasterSections','team'));
    }
    
   // network

 public function listnetwork()
{
    // Get active webmaster sections
    $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();

    // Get all travel teams, latest first
    $teams = AdminNetwork::latest()->get();

    // Add full image URL for each team if image exists
    foreach ($teams as $team) {
        if (!empty($team->image)) {
            $team->image = url('uploads/topics/' . $team->image);
        } else {
            $team->image = null;
        }
    }

    // Return view with teams and sections
    return view('dashboard.network.listteam', compact('GeneralWebmasterSections', 'teams'));
}


        public function networkdetails($id)
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')
        ->get();
        
        $team = AdminNetwork::with('networkplayers')->findOrFail($id);

        return view('dashboard.network.view', compact('GeneralWebmasterSections','team'));
    } 
    
    
    
	
}
