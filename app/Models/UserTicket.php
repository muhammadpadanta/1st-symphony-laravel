<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    use HasFactory;

    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'order_id',
        'ticket_link',
        'created_at',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
