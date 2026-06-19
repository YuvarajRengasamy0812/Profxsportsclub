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
use App\Models\ReferralCommission;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
			'referral_code' => 'nullable|exists:users,referral_code',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
		//DB::beginTransaction();
        /*Create User Here*/
		$user = User::create([
            'name' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'registration_mode' => $data['registration_mode'],
            'phone' => $data['contact_phone'],
            'nationalities' => $data['nationalities'],
            'referred_by' => $data['referral_code'],
            'wallet_amount' => 0,
            'password' => Hash::make($data['password']),
            'status' => true,
			'user_type' => 2,
            'permissions_id' => Helper::GeneralWebmasterSettings("permission_group"),    // Permission Group ID
        ]);		
		
		event(new Registered($user));
		
		/*Email verification send here*/
		return redirect()->route('verification.notice');
		
		
		// 2. Distribute registration commissions
        //$this->distributeRegistrationCommission($user->id, $user->name, 100); // assume ₹100 registration value
        //DB::commit();
		
		//return $user;
    }
	
	/**
     * After registration response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return void
     */
    protected function registered(Request $request, $user)
    {
        session()->flash('success', 'Login successfully!');
    }
	
	
	public function distributeRegistrationCommission($newUserId, $newuserName, $baseAmount)
	{
		$percentages = [
			1 => 15,
			2 => 10,
			3 => 5,
		];

		$level = 1;
		$referrer = User::find($newUserId)->referrer;

		while ($referrer && $level <= 3) {
			$percent = $percentages[$level];
			$commissionAmount = ($baseAmount * $percent) / 100;

			$description = "Level $level Referral Bonus from {$newuserName}";
			
			ReferralCommission::create([
				'from_user_id' => $newUserId,
				'to_user_id' => $referrer->id,
				'amount' => $commissionAmount,
				'percent' => $percent,
				'level' => $level,
				'description' => $description,
			]);

			// Update wallet
			$wallet = Wallet::firstOrCreate(['user_id' => $referrer->id], ['balance' => 0]);
			$wallet->increment('balance', $commissionAmount);
			
			// Create wallet transaction
			WalletTransaction::create([
				'user_id' => $referrer->id,
				'from_user_id' => $newUserId,
				'amount' => $commissionAmount,
				'type' => 'credit',
				'description' => 'Referral bonus from ' . User::find($newUserId)->name,
			]);

			$referrer = $referrer->referrer;
			$level++;
		}
	}
}
