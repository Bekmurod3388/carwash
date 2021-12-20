<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Auth::routes([
    'confirm' => false,
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    Route::resource('cost',CostController::class);
    Route::resource('price',PriceController::class);
    Route::resource('users',UserController::class);
    Route::resource('worker',WorkerController::class);


});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
