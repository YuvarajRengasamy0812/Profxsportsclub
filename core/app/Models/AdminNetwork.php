<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNetwork extends Model
{
    // 🔹 Exact table name
    protected $table = 'adminnetworks';

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'sports',
         'entryFee' ,
        'game',
        'max_networks',
        'booked_networks',
        'status',
        'image',
    ];

    // Team → Players relationship
    public function networkplayers()
    {
        return $this->hasMany(NetworkPlayer::class, 'team_id');
    }

    // Team → Bookings relationship
    public function networkbookings()
    {
        return $this->hasMany(AdminNetworkBooking::class, 'team_id');
    }
}
