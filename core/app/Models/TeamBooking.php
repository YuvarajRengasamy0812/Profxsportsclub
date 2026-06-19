<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamBooking extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel conventions)
    protected $table = 'team_bookings';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'team_id',
        'sport_title',
    ];

    /**
     * The user who made the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The team that was booked
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
