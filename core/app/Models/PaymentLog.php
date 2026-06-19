<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'payment_amount',
        'payment_type',
        'payment_reference_id',
        'payment_status',
        'payment_url',
        'payment_req',
        'payment_res',
        'payment_purpose',
        'initiated_by',
        'log_status',
        'payment_res',
        'usdt_wallet_id',
        'usdt_wallet_qr',
        'deposit_proof',
        'travel_id', 'network_id', 'game'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'email_id', 'email');
    }
}
