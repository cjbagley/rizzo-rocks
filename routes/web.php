<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);
Route::get('/browse/games', [AppController::class, 'games']);
Route::get('/browse/list', [AppController::class, 'list']);
