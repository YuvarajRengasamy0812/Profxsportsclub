<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SportsUser extends Authenticatable
{
    protected $table = 'sportsusers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}