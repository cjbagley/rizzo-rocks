<?php

namespace App\Http\Controllers\Admin;

use App\Api\GameLookupService;
use App\Helpers\Helpers;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GameController extends AuthController
{
    private const INDEX_ROUTE = 'games.index';

    final protected const HEADER = ['header' => 'Games'];

    private function getFormData(?Game $game = null): array
    {
        $helpers = new Helpers();
        $is_update = $game instanceof \App\Models\Game && $game->exists;

        return [
            'id' => $helpers->firstNonEmpty([$game?->id]),
            'title' => $helpers->firstNonEmpty([$game?->title, old('title', request()->title)]),
            'igdb_id' => $helpers->firstNonEmpty([$game?->igdb_id, old('igdb_id', request()->igdb_id)]),
            'igdb_cover_id' => $helpers->firstNonEmpty([$game?->igdb_cover_id, old('igdb_cover_id', request()->igdb_cover_id)]),
            'igdb_url' => $helpers->firstNonEmpty([$game?->igdb_url, old('igdb_url', request()->igdb_url)]),
            'played_years' => $helpers->firstNonEmpty([$game?->played_years, old('played_years', request()->played_years)]),
            'comments' => $helpers->firstNonEmpty([$game?->comments, old('comments', request()->comments)]),
            'is_update' => $is_update,
            'form_route' => $is_update ? route('games.update', $game->slug) : route('games.store'),
        ];
    }

    public function index()
    {
        return view('admin.games.index')->with('games', Game::all())->with(self::HEADER);
    }

    public function create(Request $request)
    {
        if ($request->has('lookup-id')) {
            $game_lookup = new GameLookupService();
            $data = $game_lookup->getGameDataFromId($request->get('lookup-id'));
            $game = new Game([
                'title' => $data->name,
                'igdb_id' => $data->id,
                'igdb_cover_id' => $data->cover_image_id,
                'igdb_url' => $data->info_url,
            ]);
            return view('admin.games.form', $this->getFormData($game));
        }

        return view('admin.games.form', $this->getFormData());
    }

    public function store(GameRequest $request)
    {
        $game = new Game();
        $game->fill($request->validated());
        $game->save();
        Session::flash('success', sprintf('%s added', $game->title));

        return Redirect::to(route(self::INDEX_ROUTE));
    }

    public function edit(Game $game)
    {
        return view('admin.games.form', $this->getFormData($game));
    }

    public function update(GameRequest $request, Game $game)
    {
        $game->fill($request->validated());
        $game->save();
        Session::flash('success', sprintf('%s added', $game->title));

        return Redirect::to(route(self::INDEX_ROUTE));
    }

    public function destroy(Game $game)
    {
        $game->delete();
        Session::flash('success', sprintf('%s deleted', $game->title));

        return Redirect::to(route(self::INDEX_ROUTE));
    }
}
