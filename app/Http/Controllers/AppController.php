<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Inertia\Inertia;
use Inertia\Response;

class AppController
{
    public function index(): Response
    {
        return Inertia::render('Index');
    }

    public function games(): Response
    {
        $games = Game::all();
        foreach ($games as $game) {
            $game->cover = $game->getCoverImageUrl();
        }
        return Inertia::render('Games')->with('games', $games);
    }

    public function list(): Response
    {
        return Inertia::render('List');
    }
}
