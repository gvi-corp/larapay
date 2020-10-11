<?php

use App\Http\Controllers\DigitizedCardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PANController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pan',PANController::class);
Route::resource('digitized_cards', DigitizedCardController::class);
