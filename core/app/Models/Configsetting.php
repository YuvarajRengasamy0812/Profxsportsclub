<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configsetting extends Model
{
    use HasFactory;
    protected $table = 'configsettings';
    public $timestamps=false;

    protected $fillable = ['key', 'value'];
}
