<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\OrderController;
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
// User Routes
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware(['auth:sanctum']);
Route::get('me',[AuthController::class,'me'])->middleware(['auth:sanctum']);
Route::post('/verify', [AuthController::class, 'verify'])->name('verification.verify');
Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ResetPasswordController::class, 'resetPassword']);
Route::post('orders', [OrderController::class, 'store'])->middleware(['auth:sanctum']);


Route::get('/artists', [UserController::class, 'getAllArtists']);
Route::get('/concerts', [UserController::class, 'getAllConcerts']);
Route::get('/ticket_types', [UserController::class, 'getAllTicketTypes']);
Route::get('/concert_tickets', [UserController::class, 'getAllConcertTickets']);

Route::put('updateuser/{id}',[UpdateUserController::class,'updateuser']);
Route::delete('deleteuser/{id}',[UserController::class,'deleteuser']);

// User Routes
Route::post('/order/success', 'App\Http\Controllers\OrderController@success')->middleware(['auth:sanctum']);


// admin routes
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

        Route::get('/admin/orders', [AdminController::class, 'getAllOrders']);

    //CRUD ARTISTS
    Route::get('/admin/artists', [AdminController::class, 'getAllArtists']);
    Route::post('/admin/artists', [AdminController::class, 'createArtist']);
    Route::get('/admin/artists/{id}', [AdminController::class, 'getArtist']);
    Route::put('/admin/artists/{id}', [AdminController::class, 'updateArtist']);
    Route::delete('/admin/artists/{id}', [AdminController::class, 'deleteArtist']);

    //CRUD CONCERTS
    Route::get('/admin/concerts', [AdminController::class, 'getAllConcerts']);
    Route::post('/admin/concerts', [AdminController::class, 'createConcert']);
    Route::get('/admin/concerts/{id}', [AdminController::class, 'getConcert']);
    Route::put('/admin/concerts/{id}', [AdminController::class, 'updateConcert']);
    Route::delete('/admin/concerts/{id}', [AdminController::class, 'deleteConcert']);

    //CRUD USERS
        Route::get('/admin/users', [AdminController::class, 'getAllUsers']);
        Route::post('/admin/users', [AdminController::class, 'createUser']);
        Route::get('/admin/users/{id}', [AdminController::class, 'getUser']);
        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser']);
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);

    // CRUD TICKETS_TYPES
        Route::get('/admin/ticket_types', [AdminController::class, 'getAllTicketTypes']);
        Route::post('/admin/ticket_types', [AdminController::class, 'createTicketType']);
        Route::get('/admin/ticket_types/{id}', [AdminController::class, 'getTicketType']);
        Route::put('/admin/ticket_types/{id}', [AdminController::class, 'updateTicketType']);
        Route::delete('/admin/ticket_types/{id}', [AdminController::class, 'deleteTicketType']);

    // CRUD CONCERTS_TICKETS
        Route::get('/admin/concert_tickets', [AdminController::class, 'getAllConcertTickets']);
        Route::post('/admin/concert_tickets', [AdminController::class, 'createConcertTicket']);
        Route::get('/admin/concert_tickets/{id}', [AdminController::class, 'getConcertTicket']);
        Route::put('/admin/concert_tickets/{id}', [AdminController::class, 'updateConcertTicket']);
        Route::delete('/admin/concert_tickets/{id}', [AdminController::class, 'deleteConcertTicket']);
// admin routes
});













//Route::get('listuser',[UserController::class,'listuser'])->middleware(['auth:sanctum']);
//Route::get('cariuser/{id}',[UserInfoController::class,'cariuser']);























//Route::post('tambahProduk',[ProductController::class,'tambahProduk']);
//Route::get('list',[ProductController::class,'list']);
//Route::delete('delete/{id}',[ProductController::class,'delete']);
//Route::get('update/{id}',[ProductController::class,'update']);
//Route::put('updateproduk/{id}',[ProductController::class,'updateproduk']);
//
//Route::get('kategori',[KategoriController::class,'kategori']);
//Route::post('tambahkategori',[KategoriController::class,'tambahKategori']);
//Route::delete('deletekat/{id}',[KategoriController::class,'deletekat']);
//Route::get('listkat/{id}',[KategoriController::class,'listkat']);
//Route::put('updatekat/{id}',[KategoriController::class,'updatekat']);
//
//Route::post('order',[PesananController::class,'tambahPesanan']);
//Route::get('listpesanan',[PesananController::class,'list']);
//
//Route::post('message',[MessageController::class,'tambahMessage']);
//Route::get('listmessage',[MessageController::class,'list']);
