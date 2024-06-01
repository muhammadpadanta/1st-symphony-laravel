<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    function cariuser ($id) 
    {
        return User::find($id);
    }
}
