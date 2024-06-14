<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'gender',
        'birth',
        'phone',
        'address',
        'pfp_path',
        'role',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // Hide Password in results.json
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'user_id';

    public $timestamps = false;
}
