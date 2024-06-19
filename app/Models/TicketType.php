<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'concert_id',
        'type_name',
        'price',
    ];

    public function concertTickets()
    {
        return $this->hasMany(ConcertTicket::class, 'ticket_type_id', 'ticket_type_id');
    }
    public function concert()
    {
        return $this->belongsTo(Concert::class, 'concert_id');
    }


    protected $primaryKey = 'ticket_type_id';

    public $timestamps = false;
}
