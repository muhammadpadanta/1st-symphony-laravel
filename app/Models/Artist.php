<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'genre',
        'photo',
        'bio',
    ];

    public function concerts()
    {
        return $this->hasMany(Concert::class, 'artist_id', 'artist_id');
    }

    protected $primaryKey = 'artist_id';

    public $timestamps = false;

}


