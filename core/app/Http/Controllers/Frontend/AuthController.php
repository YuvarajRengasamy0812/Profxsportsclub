<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\MailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
class AuthController extends Controller
{
    // REGISTER
  	protected $redirectTo = '/email/verify';
    protected $mailService;

     public function __construct(MailService $mailService)
    {
        $this->middleware('guest')->except('logoutcustomer');
        $this->mailService = $mailService;
    }
    // LOGIN
    public function customerlogin(Request $request)
    {

        
       $credentials = $request->only('email', 'password');
       
       $user = \App\Models\User::where('email', $request->email)->first();


        if ($user) {
        // If user exists but wrong password
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['password' => 'Incorrect password']], 422);
            }
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }
    }
       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // echo '<pre>';print_r($user->user_type );exit;
            if ($user->user_type == 2) {
                $redirect = '/crmdashboard';
            }  else {
                Auth::logout();
                if ($request->ajax()) {
                    return response()->json(['errors' => ['Access denied.']], 422);
                }
                 return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
            }

            if ($request->ajax()) {
                return response()->json(['redirect' => $redirect]);
            }
            return redirect($redirect)->with('success', 'Login Page successfully.');
        }

        if ($request->ajax()) {
            return response()->json(['errors' => ['Invalid credentials']], 422);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
       
    }

  public function customer(){

//  echo'<pre>';print_r('test');exit;
        return view('frontEnd.sportsuser.login');
    }
 
public function logoutcustomer(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/customer')->with('success', 'Logged out successfully.');
}


    protected function sportsRegister(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'              => 'required|string|max:255',
        'email'                  => 'required|string|email|max:255|unique:users',
        'password'               => 'required|string|min:6',
        'real_password'          => 'required|string|min:6|same:password',
        'phone'          => 'required|string|max:20',
        'nationalities'          => 'required|string|max:20',
        'company'          => 'required|string|max:20',
        'designation'  =>'required|string|max:20',
           'interest'  =>'required|string|max:20',
    ], [
        'email.unique'           => 'This email is already registered.',
        'real_password.same'      => 'Password and Confirm Password do not match.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    DB::beginTransaction();

    try {
        $user = User::create([
            'name'      => $request->name,
    
           'interest' =>  $request->interest,
            'company'  => $request->company,
             'designation'  => $request->designation,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'nationalities'=>$request->nationalities,
            'password'  => Hash::make($request->password),
            'real_password'   => $request->real_password,
            'status'    => true,
            'user_type' => 2,
             'permissions_id' => 2, // ⭐ ADD THIS LINE
        ]);

        $user->update([
            'userid' => 'PROFX' . (10000 + $user->id),
        ]);

        
            $verificationLink = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );
            
            $templateVars = [
                'name'             => $user->name,
                'server_name'      => 'PROFX SportsClub',
                'site_link'        => 'https://profxsportsclub.com',
                'email'            => $user->email,
                'verificationUrl'=> $verificationLink,
            ];
            
            $this->mailService->sendEmail(
                $user->email,         // recipient
                'PROFX SPORTSCLUB - Email Verification!', // subject
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

  public function customerdashboard(){
     $countries = Country::all();

        return view('frontEnd.sportsuser.register',compact('countries'));
        }
}