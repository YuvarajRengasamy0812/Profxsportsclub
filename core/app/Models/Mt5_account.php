<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mt5_account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'company_title',
        'mt5_company_name',
        'mt5_server_ip',
        'mt5_server_port',
        'mt5_server_web_login',
        'mt5_server_web_password' ,
        'status',
        'created_at',
        'updated_at'
    ];

   
    
}
