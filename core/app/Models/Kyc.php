<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kyc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'userid',
        'email',
        'typedocument',
        'kyc_type',
        'address_type',
        'kyc_fileidfirst' ,
        'kyc_fileidsecond',
        'address_proof',
        'adminremark',
        'approvedby',
        'status', 
        'created_at',
        'updated_at'
    ];

    public function user()  // lowercase
{
    return $this->belongsTo(User::class, 'userid'); // 'userid' is the foreign key in KYC table
}
    
}
