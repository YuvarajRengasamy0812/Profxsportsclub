<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentOrders extends Model
{
    use HasFactory;
    const UPDATED_AT =null;
    protected $table='tournaments_deals';
    protected $fillable = ['id', 'tournament_id', 'order_id', 'login', 'deal_id', 'contractsize', 'symbol', 'price', 'rateprofit', 'ratemargin', 'positionid', 'comment', 'profitraw', 'profit', 'volume', 'time_closed', 'status', 'created_at', 'stored_orders'];
    public function user(){
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
