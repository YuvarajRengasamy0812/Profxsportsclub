<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTravel extends Model
{
    // 🔹 Exact table name
    protected $table = 'admintravels';

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'sports',
         'entryFee' ,
        'game',
        'max_travelers',
        'booked_travelers',
        'status',
        'image',
    ];

    // Team → Players relationship
    public function travelplayers()
    {
        return $this->hasMany(TravelPlayer::class, 'team_id');
    }

    // Team → Bookings relationship
    public function tarvelbookings()
    {
        return $this->hasMany(AdminTravelBooking::class, 'team_id');
    }
}
