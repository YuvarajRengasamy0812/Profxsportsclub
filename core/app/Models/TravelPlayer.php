<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPlayer extends Model
{
    protected $table = 'travel_players';

    protected $fillable = [
        'team_id',
        'user_id', // optional if you want to link players to users
        'name'
    ];

    // Player → Team
    public function travel()
    {
        return $this->belongsTo(AdminTravel::class, 'team_id');
    }
}
