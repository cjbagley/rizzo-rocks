<?php

use App\Http\Controllers\Admin\GameCaptureController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\LookupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\AppController;
use App\Http\Middleware\CanAccessAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);
Route::get('/browse/games', [AppController::class, 'games']);
Route::get('/browse/game/{game}', [AppController::class, 'game'])->name('game.view');
Route::get('/browse/list', [AppController::class, 'list']);
Route::post('/browse/list', [AppController::class, 'list']);

Route::get('/admin', function () {
    return view('admin.dashboard', ['header' => 'Dashboard']);
})->middleware(['auth', 'verified', CanAccessAdmin::class])->name('dashboard');

Route::middleware(['auth', 'verified', CanAccessAdmin::class])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lookup', [LookupController::class, 'form'])->name('lookup.form');
    Route::post('/lookup', [LookupController::class, 'search'])->name('lookup.search');

    Route::resource('games', GameController::class)->except(['show']);
    Route::resource('tags', TagController::class)->except(['show']);
    Route::resource('games/{game}/captures', GameCaptureController::class)->except(['show']);
});

require __DIR__.'/auth.php';
