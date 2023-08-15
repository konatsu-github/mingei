<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\VideoController;
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




Route::get('/ranking',   [VideoController::class, 'rankingIndex'])->name('ranking');

// Route::get('/recommend', function () {
//     return view('recommend');
// })->name('recommend');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware(['auth'])->name('profile.show');

Route::get('/settings', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::post('/settings', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');

Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth'])->name('notifications');

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth'])->name('upload');

Route::get('/',  [VideoController::class, 'index'])->name('home');

Route::get('/watch/{videoId}', [VideoController::class, 'show'])->name('watch');

Route::post('/upload', [VideoController::class, 'store'])->middleware(['auth'])->name('video.upload');
// Route::get('/notifications', function () {
//     return view('notifications');
// })->middleware(['auth'])->name('notifications');

require __DIR__.'/auth.php';
