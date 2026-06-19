<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'name',
		'lastname',
        'email',
        'password',
        'real_password',
        'photo',
        'permissions_id',
        'status',
        'permissions',
        'connect_email',
        'connect_password',
        'provider_id',
        'provider',
        'access_token',
    	'referred_by',
    	'role',
    	'interest',
    	'designation',
         'company',
    	'registration_mode',
    	'wallet_amount',
    	'nationalities',
    	'user_type',
    	 'phone',
        'country_code',
        'email_verified_at',
        'payment_status',
        'certificate_path',
        'kyc_document_type',
        'kyc_status',
        'kyc_document_path',
        'profile_image',
        'resendemail_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

	public function sendEmailVerificationNotification()
	{
		$this->notify(new \App\Mail\CustomVerifyEmail());
	}

    // relation with Permissions
    public function permissionsGroup()
    {
        return $this->belongsTo('App\Models\Permissions', 'permissions_id');
    }

	// Users referred by this user
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by', 'referral_code'); // 3rd param for custom key
    }

    // The person who referred this user
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by', 'referral_code');
    }
	protected static function booted()
	{
		static::creating(function ($user) {
			$user->referral_code = strtoupper(Str::random(8));
		});
		
		/*static::created(function ($user) {
			$user->userid = 'PROFX'.(10000 + $user->id);
			$user->save();
		});*/
	}

	public function earnedCommissions()
	{
		return $this->hasMany(ReferralCommission::class, 'to_user_id');
	}

	public function wallet()
	{
		return $this->hasOne(Wallet::class);
	}
      // Add these two required methods:
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
