<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'catname',
        'parent_id',
        'slug',
		'registerstartDate',
		'eventstartDate',
        'description',
        'status',
    ];

    // Parent category relationship
    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }
}
