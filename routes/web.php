<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CheckOutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProdukController::class, 'index'])->name('home');
Route::get('/addtocart', [CartController::class, 'store'])->middleware('auth');
Route::get('/delfromcart', [CartController::class, 'destroy'])->middleware('auth');
Route::get('/register', function () {
    return view('register', ['title'=>'Regiser']);
})->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');
Route::get('/login', function () {
    return view('login', ['title'=>'Login']);
})->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');

Route::get('/cart', [CartController::class, 'show'])->middleware('auth');

Route::get('/checkout', [CheckOutController::class, "index"])->middleware('auth');

Route::post('/checkout',[CheckOutController::class, "post"])->middleware('auth');
Route::post('/checkout/accept',[CheckOutController::class, "store"])->middleware('auth');


Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');

// Route::get('/debug', function(){
//     $id = Auth::id();
//    dd(DB::select("SELECT SUM(total_harga) FROM carts WHERE id_user = $id;")[0]);
// });