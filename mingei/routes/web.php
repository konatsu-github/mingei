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

Route::get('/watch', function () {
    return view('watch');
})->name('watch');

Route::get('/ranking', function () {
    return view('ranking');
})->name('ranking');

Route::get('/recommend', function () {
    return view('recommend');
})->name('recommend');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

Route::get('/setting', function () {
    return view('setting');
})->middleware(['auth'])->name('setting');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications');

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth'])->name('upload');

// Route::get('/notifications', function () {
//     return view('notifications');
// })->middleware(['auth'])->name('notifications');

require __DIR__.'/auth.php';
