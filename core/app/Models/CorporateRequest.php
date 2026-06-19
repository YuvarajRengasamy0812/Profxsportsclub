<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateRequest extends Model
{
    protected $table = 'corporate_requests';

    protected $fillable = [
        'user_id',
        'company',
        'contact',
        'email',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
