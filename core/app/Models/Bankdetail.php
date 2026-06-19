<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bankdetail extends Model
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
        'bank_name',
        'account_holder',
        'account_number',
        'ifsccode',
        'swift_code' ,
        'status',
        'isdefault',
        'bank_proof'
    ];

    
}
