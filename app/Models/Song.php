<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $primaryKey = 'song_id';

    protected $fillable = [
        'artist_id',
        'title',
        'link_id',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'artist_id');
    }

   public $timestamps = false;
}
