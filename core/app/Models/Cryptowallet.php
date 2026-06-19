<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cryptowallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'wallet_name',
        'wallet_crypto',
        'wallet_network',
        'wallet_address',
        'status',
        'swift_code' ,
        'status',
        'wallet_proof'
    ];

    
}
