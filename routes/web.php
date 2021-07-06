<?php

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

Route::get('/', function () {
    return view('auth/login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//Route::get('/profile', function(){
//    return view('profile');
//})->name('profile');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'profile'], function (){
       Route::get('/', [ProfileController::class, 'index'])->name('account.profile');

    });
});

require __DIR__.'/auth.php';
