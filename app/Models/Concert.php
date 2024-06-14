<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $hidden = ['artist_id'];
    protected $primaryKey = 'concert_id';
    protected $appends = ['artist_name'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'artist_id');
    }

    protected $fillable = [
        'artist_id',
        'concert_name',
        'date',
        'venue',
        'description',
        'concert_photo'
    ];

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class, 'concert_id', 'concert_id');
    }

    public function getArtistNameAttribute()
    {
        return $this->artist->name;
    }

    public $timestamps = false;
}
