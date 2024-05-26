<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function kategori()
    {
        return Kategori::all();
    }

    function tambahKategori(Request $req){
        // Log the request data
        
        $product = new Kategori;
        $product->judul = $req->input('judul');
        $product->jumlah_produk = $req->input('jumlah_produk');
        $product->file_path = $req->input('file_path');
      
        if ($req->hasFile('file')) {
            // Handle file if present
            $product->file_path = $req->file('file')->store('kategori');
        } else {
            // Set default values or leave them empty based on your requirements
            $product->file_path = null; // Change this according to your needs
        }

        $product->save();
        return $req->input();
    }

    function list()
    {
        return Kategori::all();
    }

    function deletekat($id)
    {
        $result=Kategori::where('id',$id)->delete();
        if($result){
            return["result"=>"Kategori telah dihapus!"];
        }else{
            return["result"=>"Kategori tidak ditemukan"];
        }
        

    }

    function listkat ($id) 
    {
        return Kategori::find($id);
    }



    function updatekat ($id, Request $req)
    {
        // return $req->input();
        $product = Kategori::find($id);
        $product->judul = $req->input('judul');
        $product->jumlah_produk = $req->input('jumlah_produk');


        if ($req->file('file')) {
            $product->file_path = $req->file('file')->store('kategori');
        } 

        $product->save();
        return $req->input();
    }
}
