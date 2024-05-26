<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function tambahMessage(Request $req){
        // Log the request data
        
        $product = new Message;
        $product->nama = $req->input('nama');
        $product->email = $req->input('email');
        $product->pesan = $req->input('pesan');


        $product->save();
        return $req->input();
    }

    function list()
    {
        return Message::all();
    }
}
