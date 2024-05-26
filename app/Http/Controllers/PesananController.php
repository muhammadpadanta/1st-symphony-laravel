<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    function tambahPesanan(Request $req){
        // Log the request data
       
        $product = new Pesanan;
        $product->id_barang = $req->input('id_barang');
        $product->nama_pembeli = $req->input('nama_pembeli');
        $product->alamat_pembeli = $req->input('alamat_pembeli');
        $product->metode_pembayaran = $req->input('metode_pembayaran');
        $product->subtotal = $req->input('subtotal');
        $product->tanggal_pesanan = now()->toDateString();
        $product->status_pembayaran = 'pending';

        $product->save();
        return $req->input();
    }

    function list()
    {
        return Pesanan::all();
    }

}
