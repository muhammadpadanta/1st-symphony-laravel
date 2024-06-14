<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UpdateUserController extends Controller
{
    public function updateuser($user_id, UserRequest $req)
    {
        $user = User::find($user_id);

        $data = $req->validated();

        if ($req->has('password')) {
            $data['password'] = bcrypt($req->input('password'));
        }

        if ($req->has('birth')) {
            $data['birth'] = (new \DateTime($req->input('birth')))->format('Y-m-d');
        }

        if ($req->has('address')) {
            $data['address'] = $req->input('address');
        }

        if ($req->has('phone')) {
            $data['phone'] = $req->input('phone');
        }
        if ($req->has('gender')) {
            $data['gender'] = $req->input('gender');
        }


        if ($req->hasFile('profile_picture')) {
            $path = $req->file('profile_picture')->store('userpfps');
            $data['pfp_path'] = $path;
        }

        $user->fill($data)->save();

        return response()->json(['message' => 'Data updated successfully']);
    }
}
