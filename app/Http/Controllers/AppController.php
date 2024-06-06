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
        $game_captures = GameCapture::orderBy('title');
        $game_ids = $game_captures->pluck('id')->toArray();
        // In theory, should only get tags linked to games with the below
        // In practice, I'm setting up the data so I know they are all linked,
        // so not spending time on it at this point.
        $tags = Tag::orderBy('tag')->get();

        $data = [
            'tags' => $tags,
            'data' => $game_captures->paginate(self::PER_PAGE),
        ];

        return $request->wantsJson()
            ? response()->json($data['data'])
            : Inertia::render('List')->with('data', $data);
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
