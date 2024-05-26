<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\UserRequest; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
// Code to manage Login process 
public function login(Request $req)
{
    
    $user = User::where('username', $req->input('username'))->first();

    if ($user && Hash::check($req->input('password'), $user->password)) {
        return ["role" =>"user", "username" => $user->username];
    }

    
    return response()->json(['error' => 'These credentials do not match our records.'], 401);
}

 // Code to manage Register process 
public function register(UserRequest $request)
{
    $validatedData = $request->validated();
    
        // Handle file upload if a file is provided
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('userpfp');
            $validatedData['file_path'] = $filePath;
        }
    
        // Create the user
        $user = User::create($validatedData);
    
        // Return a custom response with the created user
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
    

    function cariuser ($id) 
    {
        return User::find($id);
    }

    function listuser()
    {
        return user::all();
    }

    function deleteuser($id)
    {
        $result=User::where('id',$id)->delete();
        if($result){
            return["result"=>"User telah dihapus!"];
        }else{
            return["result"=>"User tidak ditemukan"];
        }
        

    }

    
    function updateuser($id, Request $req)
{
    $user = User::find($id);

    if ($req->has('username')) {
        $user->username = $req->input('username');
    }

    if ($req->has('email')) {
        $user->email = $req->input('email');
    }

    if ($req->has('password')) {
        $user->password = bcrypt($req->input('password'));
    }

    if ($req->file('file')) {
        $user->file_path = $req->file('file')->store('userpfp');
    } 

    $user->save();

    return $user->toArray();
}



}
