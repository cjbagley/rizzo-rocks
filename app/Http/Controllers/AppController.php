<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCapture;
use App\Models\Tag;
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
        // In theory, should only get tags linked to games with the below
        // In practice, I'm setting up the data so I know they are all linked,
        // so not spending time on it at this point.
        $tags = Tag::orderBy('tag')->get();
        $game_captures = GameCapture::orderBy('title')
            ->paginate(self::PER_PAGE);

        return $request->wantsJson()
            ? response()->json($game_captures)
            : Inertia::render('List')->with('data', [
                'tags' => $tags,
                'data' => $game_captures,
            ]);
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
