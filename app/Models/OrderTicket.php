<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'concert_ticket_id',
        'quantity',
    ];

    public function concertTicket()
    {
        return $this->belongsTo('App\Models\ConcertTicket', 'concert_ticket_id');
    }

    public $timestamps = false;
}
