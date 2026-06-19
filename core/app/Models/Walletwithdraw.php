<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Walletwithdraw extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $table = 'wallet_withdraws';
    protected $fillable = [
        'id',
        'user_id',
        'email',
        'status',
        'transaction_remarks',
        'wallet_balance',
        'withdraw_type',
        'withdraw_account',
        'withdraw_amount',
        'withdraw_proof'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
}
