<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Mt5_account;
use App\Models\account_type;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'leagurTitle',
        'categoryid',
        'league_certificate',
        'subcategoryid',
        'leagurEntryfees',
        'leagurStartdate',
        'leagurEnddate',
        'leagurtotPartic',
        'leagurImage',
        'description',
        'privacydescription',
        'rulesdescription',
        'Mt5groupid',
        'mt5_server_id',
        'leaderboard_option',
        'created_by',
        'created_at',
        'updated_at'
    ];

    // ✅ League belongs to a Category
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categoryid', 'id');
    }

    // ✅ League belongs to a Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Categorie::class, 'subcategoryid', 'id');
    }

    // ✅ League belongs to an MT5 Server
    public function mt5Server()
    {
        return $this->belongsTo(Mt5_account::class, 'mt5_server_id', 'id');
    }
    
    public function accounttype()
{
    return $this->belongsTo(account_type::class, 'Mt5groupid', 'ac_index'); 
    // ac_index = primary key in mt5 groups table
}
}