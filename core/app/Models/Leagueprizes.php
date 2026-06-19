<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Mt5_account;
use App\Models\League;

class Leagueprizes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'categoryid',
        'subcategoryid',
        'tournament_id',
        'totalprize',
        'prizevalue',
        'status',
        'created_by',
        'created_at',
        'updated_at',
		'updated_by'
    ];
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categoryid', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Categorie::class, 'subcategoryid', 'id');
    }
	
    public function league()
    {
        return $this->belongsTo(League::class, 'tournament_id', 'id');
    }
}