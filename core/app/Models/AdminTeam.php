<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTeam extends Model
{
    // 🔹 Exact table name
    protected $table = 'adminteams';

    protected $fillable = [
        'user_id',
        'name',
        'sports',
        'game',
        'entryFee',
        'max_players',
        'booked_players',
        'status',
        'logo'
    ];

    // Team → Players relationship
    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    // Team → Bookings relationship
    public function bookings()
    {
        return $this->hasMany(AdminTeamBooking::class, 'team_id');
    }
}
