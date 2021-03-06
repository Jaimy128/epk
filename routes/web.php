<?php

use App\Http\Controllers\BandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\BandController::class, 'index']);

Auth::routes();
Route::post('/bands/{band}/toggle-moderator', [App\Http\Controllers\BandController::class, 'toggleModerator'])->name('bands.toggleModerator');
Route::resource('bands', App\Http\Controllers\BandController::class);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-account', [App\Http\Controllers\HomeController::class, 'changeAccount'])->name('change-account');
Route::post('/change-account', [App\Http\Controllers\HomeController::class, 'updateAccount'])->name('update-account');
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');