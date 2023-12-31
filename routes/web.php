<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);
Route::get('/browse/games', [AppController::class, 'games']);
Route::get('/browse/list', [AppController::class, 'list']);

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
