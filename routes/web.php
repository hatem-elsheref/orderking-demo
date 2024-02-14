<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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


Route::domain('{store}.' . config('app.central_domain'))->group(function (){
    Route::middleware('identifyTenantBySubDomain')->group(function (){
        Route::get('/users/{user}', [UserController::class, 'show']);
    });
});





Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function (){
   Route::resource('products'     , ProductController::class);
   Route::resource('categories'   , UserController::class);
});


Route::view('/', 'welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');
