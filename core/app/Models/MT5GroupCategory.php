<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mt5_account;

class mt5GroupCategory extends Model
{
  
    protected $primaryKey = 'mt5_grp_cat_id'; 
    public $incrementing = true;              // it's auto-increment
    protected $keyType = 'int';               // PK is integer
    public $timestamps = true;

    protected $fillable = [
        'mt5_grp_cat_name',
        'mt5_grp_cat_desc',
        'mt5_grp_cat_type',
        'is_active',
        'mt5_server_id',
    ];
      public function server()
    {
        return $this->belongsTo(Mt5_account::class, 'mt5_server_id', 'id');
    }
}