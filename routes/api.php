<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MessageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserController::class,'register']);
Route::get('cariuser/{id}',[userController::class,'cariuser']);
Route::put('updateuser/{id}',[UserController::class,'updateuser']);
Route::delete('deleteuser/{id}',[UserController::class,'deleteuser']);
Route::get('listuser',[UserController::class,'listuser']);
Route::post('login',[UserController::class,'login']);

Route::post('tambahProduk',[ProductController::class,'tambahProduk']);
Route::get('list',[ProductController::class,'list']);
Route::delete('delete/{id}',[ProductController::class,'delete']);
Route::get('update/{id}',[ProductController::class,'update']);
Route::put('updateproduk/{id}',[ProductController::class,'updateproduk']);

Route::get('kategori',[KategoriController::class,'kategori']);
Route::post('tambahkategori',[KategoriController::class,'tambahKategori']);
Route::delete('deletekat/{id}',[KategoriController::class,'deletekat']);
Route::get('listkat/{id}',[KategoriController::class,'listkat']);
Route::put('updatekat/{id}',[KategoriController::class,'updatekat']);

Route::post('order',[PesananController::class,'tambahPesanan']);
Route::get('listpesanan',[PesananController::class,'list']);

Route::post('message',[MessageController::class,'tambahMessage']);
Route::get('listmessage',[MessageController::class,'list']);