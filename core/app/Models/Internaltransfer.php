<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Internaltransfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	 protected $table = 'internaltransfers';
    protected $fillable = [
        'id',
        'user_id',
        'email',
        'transfer_type',
        'available_balance',
        'transfer_amount'
    ];

    
}
