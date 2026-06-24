<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function index(Request $request)
    {	
        $pagetitle = "Login";
		return view("frontEnd.user.login", compact('pagetitle'));
    }
	
	// public function login(Request $request)
    // {

    //     $credentials = $request->only('email', 'password');

	// 	if (Auth::attempt($credentials)) {
	// 		$request->session()->regenerate();
	// 		$user = Auth::user();

	// 		$isAdminLogin = $request->input('login_type') === 'admin';

	// 		if($user->user_type == 1 && $isAdminLogin) {
	// 			return redirect('/admin');
	// 		} elseif ($user->user_type == 2 && !$isAdminLogin) {
	// 			return redirect('/user/dashboard');
	// 		} else {
	// 			Auth::logout();
	// 			return redirect($isAdminLogin ? '/admin/login' : '/login')
	// 				->withErrors(['email' => 'Access denied.']);
	// 		}
	// 	}

	// 	return back()->withErrors([
	// 		'email' => 'Invalid credentials',
	// 	])->withInput();

    // }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
          // Check if user exists first
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
            $isAdminLogin = $request->input('login_type') === 'admin';

            if ($user->user_type == 1 && $isAdminLogin) {
                $redirect = '/admin/clientlist';
            } elseif ($user->user_type == 2 && !$isAdminLogin) {
                $redirect = '/user/dashboard';
            } elseif ($user->user_type == 5 && !$isAdminLogin) {
                $redirect = '/user/dashboard';
            } else {
                Auth::logout();
                if ($request->ajax()) {
                    return response()->json(['errors' => ['Access denied.']], 422);
                }
                return redirect($isAdminLogin ? '/admin/login' : '/login')
                    ->withErrors(['email' => 'Access denied.']);
            }

            if ($request->ajax()) {
                return response()->json(['redirect' => $redirect]);
            }
            return redirect($redirect);
        }

        if ($request->ajax()) {
            return response()->json(['errors' => ['Invalid credentials']], 422);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    protected function credentials(Request $request)
    {
		if (config('smartend.nocaptcha_status')) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }

        // clear old sessions
        \Session()->forget('_Loader_WebmasterSettings');
        \Session()->forget('_Loader_Web_Settings');
        \Session()->forget('_Loader_Languages');
        \Session()->forget('_Loader_Events');
        \Session()->forget('_Loader_WebmasterSections');
		
        return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
    }
}
