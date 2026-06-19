<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    // protected $table = 'transactions';
protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
    'payment_log_id',
    'useremail',
    'trans_purpose',
    'trans_amount',
    'trans_currency',
    'trans_method',
    'trans_date',
    'trans_adminremark',
    'trans_status',
    'deposit_proof',
    'created_at',
    'updated_at',
    'travel_id', 'network_id', 'game'
];
 public function user()
    {
        return $this->belongsTo(User::class, 'useremail', 'email');
    }
}
