<?php

use App\Http\Controllers\Admin\HomeController;
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

Route::get('test', function (\Illuminate\Http\Request $request){
    $items = explode(',', $request->props);
    $data = [
        'columns'   => [],
        'relations' => [],
    ];

    foreach ($items as $column){
        if (!str($column)->contains('.')){
            $data['columns'][] = $column;
        }else{
            relations($data['relations'], $column);
        }
    }

    return $data;
});

// for super admin
Auth::routes(['register' => false, 'verify' => false, 'confirm' => false]);
Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function (){
    Route::get('/home'                 , [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/users'                , [HomeController::class, 'customers'])->name('admin.users');
    Route::get('/users/{merchant}'     , [HomeController::class, 'customersOfMerchant'])->name('admin.merchant.users');
    Route::get('/admins'               , [HomeController::class, 'admins'])->name('admin.admins');
    Route::get('/merchants'            , [HomeController::class, 'merchants'])->name('admin.merchants');
    Route::get('/orders'               , [HomeController::class, 'orders'])->name('admin.orders');
});

