<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// for super admin
Auth::routes(['register' => false, 'verify' => false, 'confirm' => false]);
Route::view('/', 'welcome');
Route::view('/home', 'home');

//
//
//Route::middleware(['auth'])->group(function (){
////    Route::get('/'          , [HomeController::class, 'index'])->name('merchant.dashboard');
//    Route::get('/users'     , [HomeController::class, 'users'])->name('merchant.users');
//    Route::get('/orders'    , [HomeController::class, 'orders'])->name('merchant.orders');
//    Route::get('/my-orders' , [HomeController::class, 'orders'])->name('merchant.orders');
//});

