<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetworkPlayer extends Model
{
    protected $table = 'network_players';

    protected $fillable = [
        'team_id',
        'user_id', // optional if you want to link players to users
        'name'
    ];

    // Player → Team
    public function network()
    {
        return $this->belongsTo(AdminNetwork::class, 'team_id');
    }
}
