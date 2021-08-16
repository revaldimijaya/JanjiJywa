<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeverageController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\TransactionController;
use \App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::view('/', 'homes.home')->name('home');
Route::get('/home', [BeverageController::class, 'index'])->name('beverage.get');
// Route::get('/home', [BeverageController::class, 'index'])->name('home');
Route::get('/about', function (){
    return view('about');
})->name('about');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    Route::group(['prefix' => 'profile'], function (){
        Route::get('/', [ProfileController::class, 'index'])->name('account.profile');
     });
 
     Route::group(['prefix' => 'manage', 'middleware' => 'roles:Admin,CEO'], function(){
        Route::group(['prefix' => 'create'], function(){
            Route::get('/', [BeverageController::class, 'create'])->name('manage.create');
            Route::post('/store', [BeverageController::class, 'store'])->name('manage.store');
        });
        Route::group(['prefix' => 'update'], function(){
            Route::get('/{id}', [BeverageController::class, 'edit'])->name('manage.edit');
            Route::post('/{beverage}', [BeverageController::class, 'update'])->name('manage.update');
        });
     });
 
     Route::group(['prefix' => 'beverage', 'middleware' => 'roles:Customer,Admin,CEO'], function(){
         Route::get('/{beverage}', [BeverageController::class, 'show'])->name('beverage.detail');
         Route::post('/{beverage}', [CartController::class, 'store'])->name('cart.store');
 
     });
     Route::group(['prefix' => 'cart', 'middleware' => 'roles:Customer'], function(){
         Route::get('/', [CartController::class, 'index'])->name('cart.index');
         Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
         Route::put('/{cart}', [CartController::class, 'update'])->name('cart.update');
         Route::post('/{id}/{qty}', [CartController::class, 'changeQuantity'])->name('cart.quantity');
         Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
     });
     Route::group(['prefix' => 'history', 'middleware' => 'roles:Customer'], function(){
         Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
         Route::get('/{detail}', [TransactionController::class, 'show'])->name('transaction.detail');
     });
 
     Route::group(['prefix' => 'customer', 'middleware'=>'roles:Admin,CEO'], function(){
         Route::get('/', [UserController::class, 'index'])->name('customer.index');
         Route::get('/{id}', [UserController::class, 'show'])->name('customer.detail');
         Route::delete('/{id}', [UserController::class, 'destroy'])->name('customer.destroy');
         Route::post('/unsuspend/{id}', [UserController::class, 'restore'])->name('customer.restore');
     });
 
     Route::group(['prefix' => 'income', 'middleware'=>'roles:CEO'], function(){
        Route::get('/', [BeverageController::class,'income'])->name('income.index');
     });
});
