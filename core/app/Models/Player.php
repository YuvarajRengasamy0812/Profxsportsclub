<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = [
        'team_id',
        'user_id', // optional if you want to link players to users
        'name'
    ];

    // Player → Team
    public function team()
    {
        return $this->belongsTo(AdminTeam::class, 'team_id');
    }
}
