<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'purchase_status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderTickets()
    {
        return $this->hasMany('App\Models\OrderTicket', 'order_id');
    }

    public function userTicket()
    {
        return $this->hasMany('App\Models\UserTicket', 'order_id');
    }

    public $primaryKey = 'order_id';

    public $timestamps = false;
}
