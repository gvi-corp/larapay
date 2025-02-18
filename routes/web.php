<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DigitizedCardController;
use App\Http\Controllers\PaymentController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//tweak to cut out auth middleware "static" redirection to home
Route::get('/home', function (){return redirect('/');});

Route::resource('pan',PANController::class)->middleware('auth');
Route::resource('digitized_card', DigitizedCardController::class)->middleware('auth');
Route::resource('device', DeviceController::class)->middleware('auth');
Route::resource('payment', PaymentController::class)->middleware('auth');
