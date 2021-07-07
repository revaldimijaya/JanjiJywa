<?php

use App\Http\Controllers\BeverageController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\ProfileController;

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
});

require __DIR__.'/auth.php';
