<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationsController;

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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/profile', ProfileController::class)->middleware(['auth'])->name('*','profile');
Route::resource('/setting', SettingController::class)->middleware(['auth'])->name('*','setting');
Route::resource('/notifications', NotificationsController::class)->middleware(['auth'])->name('*','notifications');

require __DIR__.'/auth.php';
