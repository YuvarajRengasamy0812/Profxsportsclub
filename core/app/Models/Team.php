<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name','user_id','logo','game','sports'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}


