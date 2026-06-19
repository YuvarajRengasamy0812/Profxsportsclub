<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTravelBooking extends Model
{
    protected $table = 'admintravel_bookings';

    protected $fillable = [
        'user_id',
        'travel_id',
        'game'
    ];

    public function travel()
    {
        return $this->belongsTo(AdminTravel::class, 'travel_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
