<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AppController
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Index');
    }

    public function games(): InertiaResponse
    {
        $games = Game::all();
        foreach ($games as $game) {
            $game->addCalculatedFields();
        }
        return Inertia::render('Games')->with('games', $games);
    }

    public function list(): InertiaResponse
    {
        return Inertia::render('List');
    }

    public function game(Request $request, Game $game): InertiaResponse
    {
        return Inertia::render('Game')->with('game', $game);
    }
}
