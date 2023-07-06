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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/live', function () {
    return view('live');
})->middleware(['auth'])->name('live');

Route::get('/community', function () {
    return view('community');
})->middleware(['auth'])->name('community');


Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

Route::get('/setting', function () {
    return view('setting');
})->middleware(['auth'])->name('setting');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications');

require __DIR__.'/auth.php';
