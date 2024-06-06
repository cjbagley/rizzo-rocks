<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCapture;
use DB;
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
        $tags = DB::table('game_capture_tag')->whereIn('game_capture_id', $game_ids)->pluck('tag_id')->unique()->toArray();

        $game_captures = $game_captures->paginate(self::PER_PAGE);

        return $request->wantsJson()
            ? response()->json($game_captures)
            : Inertia::render('List')->with('data', $game_captures);
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
