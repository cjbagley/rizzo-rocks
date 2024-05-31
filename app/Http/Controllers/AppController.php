<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCapture;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AppController
{
    const PER_PAGE = 10;

    public function index(): InertiaResponse
    {
        return Inertia::render('Index');
    }

    public function games(): InertiaResponse
    {
        return Inertia::render('Games')->with('games', Game::all());
    }

    public function list(): InertiaResponse
    {
        return Inertia::render('List')->with('data', GameCapture::paginate(self::PER_PAGE));
    }

    public function game(Request $request, Game $game): InertiaResponse
    {
        return Inertia::render('Game', [
            'game' => $game,
            'videos' => $game->videos,
            'images' => $game->images,
            'tags' => $game->tags,
        ]);
    }
}
