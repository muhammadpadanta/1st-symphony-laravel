<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcertTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_type_id',
        'total_stock',
        'sold_tickets',
    ];

    public function ticketType()
    {
        return $this->belongsTo('App\Models\TicketType', 'ticket_type_id');
    }



    protected $primaryKey = 'concert_ticket_id';

    public $timestamps = false;
}
