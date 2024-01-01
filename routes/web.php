<?php

use App\Http\Controllers\Admin\LookupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);
Route::get('/browse/games', [AppController::class, 'games']);
Route::get('/browse/list', [AppController::class, 'list']);

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lookup', [LookupController::class, 'form'])->name('lookup.form');
});

require __DIR__ . '/auth.php';
