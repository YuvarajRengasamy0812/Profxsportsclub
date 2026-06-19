<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mt5_account;

class Leaderboardrank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $table = 'leaderboards';
    protected $fillable = [
        'ac_index',
        'ac_category',
        'ac_book_type',
        'ac_name',
        'ac_min_deposit',
        'ac_max_deposit',
        'ac_max_leverage' ,
        'ac_lot_size',
        'ac_group',
        'ac_spread',
        'ac_type',
        'acc_ib_cat', 
        'ib_enabled',
        'ac_swap',
        'is_client_group',
        'inquiry_status',
        'status',
        'user_group_id',
        'display_priority',
        'mt5_server_id'
    ];

   public function server()
    {
        return $this->belongsTo(Mt5_account::class, 'mt5_server_id', 'id');
    }
    
}
