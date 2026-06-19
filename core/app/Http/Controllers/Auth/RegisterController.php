<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Services\MailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
	protected $redirectTo = '/email/verify';
    protected $mailService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MailService $mailService)
    {
        $this->middleware('guest');
        $this->mailService = $mailService;
    }

	public function index(Request $request)
    {
        $pagetitle = "Register";
		$mode = $request->query('mode');
        $refCode = $request->query('ref');
        $nationalities = Country::all();
		return view("frontEnd.user.register", compact('pagetitle', 'mode', 'nationalities', 'refCode'));
    }

    /**
     * Create a new user instance after a valid registration.
    */

	protected function userregister(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'referral_code' => 'nullable|exists:users,referral_code',
			'registration_mode' => 'required|string',
			'contact_phone' => 'required|string|max:20',
			'nationalities' => 'nullable|string|max:255',
		], [
			'email.unique' => 'This email is already registered.',
			'referral_code.exists' => 'Referral code is invalid.',
			'password.confirmed' => 'Your password and confirmation do not match.',
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
				'lastname'          => $request->lastname,
				'email'             => $request->email,
				// 'registration_mode' => $request->registration_mode,
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
			
			$user->update([
                'userid' => 'PROFX' . (10000 + $user->id),
            ]);

			//Auth::login($user);

            //    $from = 'noreply@profxleague.com';
            // $toEmail = "rajukumar.palani@gmail.com";
            // $emailSubject = 'Email Address Verification';

            // // Your email HTML content
            // $content = '
            //     <div>Welcome to PROFXSPORTSCLUB!</div>
            //     <div>You are receiving this email because you have registered for a Trading Account.</div>
            //     <div>Click the link below to activate your Trading Account:</div>
            //     <div><a href="YOUR_VERIFICATION_LINK">Activate Account</a></div>
            // ';

            // $templateVars = [
            //     'name' => 'Raju',
            //     'server_name' => 'PROFXSPORTSCLUB',
            //     'site_link' => 'https://profxleague.com',
            //     'email' => $toEmail,
            //     'content' => $content,
            //     'title_right' => 'Activate',
            //     'subtitle_right' => 'Your Account'
            // ];

            // $this->mailService->sendEmail(
            //     $toEmail,         // recipient
            //     $emailSubject,    // subject
            //     [],               // headers (ignored)
            //     '',               // use default 'emails.raw'
            //     $templateVars     // data passed to Blade
            // );

            $verificationLink = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );
            
            $templateVars = [
                'name'             => $user->name,
                'server_name'      => 'PROFXSPORTSCLUB',
                'site_link'        => 'https://profxsportsclub.com/',
                'email'            => $user->email,
                'verificationUrl'=> $verificationLink,
            ];
            
            $this->mailService->sendEmail(
                $user->email,         // recipient
                'PROFXSPORTSCLUB - Email Verification!', // subject
                [],                   // headers (ignored)
                'emails.account_verification',      // <- use the Blade template here
                $templateVars         // variables for template
            );



			// event(new Registered($user));
			//$this->distributeRegistrationCommission($user->id, $user->name, 100);
			DB::commit();


			return redirect()->route('verification.notice')->with('status', 'Verification email sent.');
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->withErrors(['error' => 'Registration failed. ' . $e->getMessage()]);
		}
	}
}
