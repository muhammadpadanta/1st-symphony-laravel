<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'gender',
        'birth',
        'phone',
        'address',
        'pfp_path'
    ];

    // Hide Password in results.json
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'user_id';

    public $timestamps = false;
}
