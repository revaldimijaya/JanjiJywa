<?php

use App\Http\Controllers\BeverageController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\TransactionController;

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

Route::get('/', [BeverageController::class, 'index'])->name('home');
Route::get('/home', [BeverageController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'profile'], function (){
       Route::get('/', [ProfileController::class, 'index'])->name('account.profile');
    });

    Route::group(['prefix' => 'manage', 'middleware' => 'roles:Admin'], function(){
       Route::group(['prefix' => 'create'], function(){
         Route::get('/', [BeverageController::class, 'create'])->name('manage.create');
         Route::post('/store', [BeverageController::class, 'store'])->name('manage.store');
       });
    });

    Route::group(['prefix' => 'beverage', 'middleware' => 'roles:Customer,Admin'], function(){
        Route::get('/{beverage}', [BeverageController::class, 'show'])->name('beverage.detail');
        Route::post('/{beverage}', [CartController::class, 'store'])->name('cart.store');
    });
    Route::group(['prefix' => 'cart', 'middleware' => 'roles:Customer,Admin'], function(){
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
        Route::put('/{cart}', [CartController::class, 'update'])->name('cart.update');
        Route::post('/{id}/{qty}', [CartController::class, 'changeQuantity'])->name('cart.quantity');
        Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });
    Route::group(['prefix' => 'history', 'middleware' => 'roles:Customer,Admin'], function(){
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/{detail}', [TransactionController::class, 'show'])->name('transaction.detail');
    });
});

require __DIR__.'/auth.php';
