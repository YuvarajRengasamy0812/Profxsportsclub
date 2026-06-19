<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTeamBooking extends Model
{
    protected $table = 'adminteam_bookings';

    protected $fillable = [
        'team_id',
        'user_id',
        'game'
    ];

    // Booking → Team
    public function team()
    {
        return $this->belongsTo(AdminTeam::class, 'team_id');
    }

    // Booking → User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
