<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{


// Register function
    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        // Handle file upload if a file is provided
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('userpfp');
            $validatedData['file_path'] = $filePath;
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

        // Return a custom response with the created user
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }


// Login function
public function login(Request $req)
{

    $user = User::where('username', $req->input('username'))->first();

    if ($user && Hash::check($req->input('password'), $user->password)) {
        return ["id" =>"$user->user_id", "username" => $user->username];
    }


    return response()->json(['error' => 'These credentials do not match our records.'], 401);
}



function listuser()
{
    return user::all();
}

// Delete user based on user_id
function deleteuser($user_id)
{
    $result=User::where('user_id',$user_id)->delete();
    if($result){
        return["result"=>"User telah dihapus!"];
    }else{
        return["result"=>"User tidak ditemukan"];
    }

}

// Update user based on user_id



}
