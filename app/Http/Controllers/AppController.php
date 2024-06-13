<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\ListPageRequest;
use App\Models\Game;
use App\Models\GameCapture;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
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

    public function list(ListPageRequest $request): InertiaResponse|JsonResponse
    {
        $q = GameCapture::select('game_captures.*')
            ->addSelect('games.title as game')
            ->join('games', 'games.id', '=', 'game_captures.game_id');

        $helpers = new Helpers();
        $search = $request->has('search')
            ? $helpers->sanitiseString((string) $request->validated('search'))
            : '';

        if ($search !== '') {
            collect(str_getcsv($search, ' ', '"'))->filter()->each(function ($part) use ($q) {
                $term = "%{$part}%";
                $q->where(function (Builder $sq) use ($term) {
                    $sq->where('game_captures.title', 'like', $term)
                        ->orWhere('games.title', 'like', $term);
                });
            });
        }

        // In theory, should only get tags linked to games with the below
        // In practice, I'm setting up the data so I know they are all linked,
        // so not spending time on it at this point.
        $data = [
            'data' => $q
                ->orderBy('game_captures.title')
                ->paginate(self::PER_PAGE)
                ->withQueryString(),
            'tags' => Tag::orderBy('tag')->get(),
            'search' => $search,
        ];

        return $request->wantsJson()
            ? response()->json($data)
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
