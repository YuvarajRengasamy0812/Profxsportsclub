<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tested extends Model
{
    use HasFactory;

    protected $table = 'form_enquriys';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'comments'
        
    ];

   
}
