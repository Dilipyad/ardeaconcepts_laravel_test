<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('login/facebook', [App\Http\Controllers\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\LoginController::class, 'handleFacebookCallback'])->name('login.facebook.callback');
Route::get('login/google', [App\Http\Controllers\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\HomeController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::group(['middleware' => ['role:super-admin']], function () {
    // Routes accessible by super-admin
});

Route::group(['middleware' => ['role:admin']], function () {
    // Routes accessible by admin
});

Route::group(['middleware' => ['role:end-user']], function () {
    // Routes accessible by end-users
});


