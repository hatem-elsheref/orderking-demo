<?php

use App\Http\Controllers\Auth\Merchant\ForgotPasswordController;
use App\Http\Controllers\Auth\Merchant\LoginController;
use App\Http\Controllers\Auth\Merchant\RegisterController;
use App\Http\Controllers\Auth\Merchant\ResetPasswordController;
use App\Http\Controllers\HomeController;
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

Route::view('/', 'welcome');

// Auth routes for merchant admin
Route::prefix('merchant-dashboard')->middleware(['is_merchant'])->group(function (){

    Route::middleware('guest')->group(function (){
        Route::get('/login'                  , [LoginController::class, 'showLoginForm'])->name('merchant.login');
        Route::post('/login'                 , [LoginController::class, 'login']);
        Route::get('/password/reset'         , [ForgotPasswordController::class, 'showLinkRequestForm'])->name('merchant.password.request');
        Route::post('/password/email'        , [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('merchant.password.email');
        Route::get('/password/reset/{token}' , [ResetPasswordController::class, 'showResetForm'])->name('merchant.password.reset');
        Route::post('/password/reset'        , [ResetPasswordController::class, 'reset'])->name('merchant.password.update');
    });

    Route::middleware(['auth', 'merchant.change'])->group(function (){
        Route::get('/'          , [HomeController::class, 'index'])->name('merchant.dashboard');
        Route::get('/users'     , [HomeController::class, 'users'])->name('merchant.users');
        Route::get('/orders'    , [HomeController::class, 'orders'])->name('merchant.orders');
        Route::get('/my-orders' , [HomeController::class, 'orders'])->name('merchant.orders');
    });

});

// Auth routes for merchant customers
Route::middleware('guest')->group(function (){
    Route::get('/login'                  , [LoginController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login'                 , [LoginController::class, 'login']);
    Route::get('/register'               , [RegisterController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('/register'              , [RegisterController::class, 'register']);
    Route::get('/password/reset'         , [ForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
    Route::post('/password/email'        , [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
    Route::get('/password/reset/{token}' , [ResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');
    Route::post('/password/reset'        , [ResetPasswordController::class, 'reset'])->name('customer.password.update');
});
