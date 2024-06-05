<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCapture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AppController
{
    public const PER_PAGE = 12;

    public function index(): InertiaResponse
    {
        return Inertia::render('Index');
    }

    public function games(): InertiaResponse
    {
        return Inertia::render('Games')->with('games', Game::all());
    }

    public function list(Request $request): InertiaResponse|JsonResponse
    {
        $data = GameCapture::paginate(self::PER_PAGE);
        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('List')->with('data', $data);
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
