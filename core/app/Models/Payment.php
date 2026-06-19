<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'corporate_payments';

    protected $fillable = ['plan_name','user_id', 'amount', 'methods', 'proof'];
}
