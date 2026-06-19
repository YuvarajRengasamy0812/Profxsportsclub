<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mt5_account;

class Mt5Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'mt5_group_id',
        'mt5_server_id',
        'mt5_group_name',
        'mt5_group_type',
        'mt5_group_desc',
        'is_active',
        'updated_by',
        'created_at',
        'updated_at',
        'user_group_id'
    ];
    
      public function server()
    {
        return $this->belongsTo(Mt5_account::class, 'mt5_server_id', 'id');
    }
}
