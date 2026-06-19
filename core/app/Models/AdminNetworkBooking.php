<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNetworkBooking extends Model
{
    protected $table = 'adminnetwork_bookings';

    protected $fillable = [
        'user_id',
        'network_id',
        'game'
    ];

    public function travel()
    {
        return $this->belongsTo(AdminNetwork::class, 'network_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
