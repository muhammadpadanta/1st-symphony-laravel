<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    function tambahProduk(Request $req){
        // Log the request data
        
        $product = new Product;
        $product->nama_produk = $req->input('nama_produk');
        $product->harga = $req->input('harga');
        $product->deskripsi = $req->input('deskripsi');
        $product->kategori = $req->input('kategori');

        if ($req->hasFile('file')) {
            // Handle file if present
            $product->file_path = $req->file('file')->store('product');
        } else {
            // Set default values or leave them empty based on your requirements
            $product->file_path = null; // Change this according to your needs
        }

        $product->save();
        return $req->input();
    }
    

    function list()
    {
        return Product::all();
    }

    function delete($id)
    {
        $result=Product::where('id',$id)->delete();
        if($result){
            return["result"=>"produk telah dihapus!"];
        }else{
            return["result"=>"Produk tidak ditemukan"];
        }
        

    }

    function update ($id) 
    {
        return Product::find($id);
    }



    function updateproduk ($id, Request $req)
    {
        // return $req->input();
        $product = Product::find($id);
        $product->nama_produk = $req->input('nama_produk');
        $product->harga = $req->input('harga');
        $product->deskripsi = $req->input('deskripsi');
        $product->kategori = $req->input('kategori');

        if ($req->file('file')) {
            $product->file_path = $req->file('file')->store('product');
        } 

        $product->save();
        return $req->input();
    }
}
