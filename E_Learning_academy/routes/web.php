<?php

use App\Http\Controllers\LandingController;
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

Auth::routes();

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contactUs', [App\Http\Controllers\LandingController::class, 'contactUs'])->name('contactUs');
Route::get('/aboutUs', [App\Http\Controllers\LandingController::class, 'aboutUs'])->name('aboutUs');
Route::get('/courses', [App\Http\Controllers\LandingController::class, 'courses'])->name('courses');
