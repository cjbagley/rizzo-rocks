<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GameController extends AuthController
{
    private function getFormData(?Game $game = null): array
    {
        $helpers = new Helpers();

        return [
            'id' => $helpers->firstNonEmpty([$game?->id]),
            'title' => $helpers->firstNonEmpty([$game?->title, old('title', request()->title)]),
            'igdb_id' => $helpers->firstNonEmpty([$game?->igdb_id, old('igdb_id', request()->igdb_id)]),
            'igdb_cover_id' => $helpers->firstNonEmpty([$game?->igdb_cover_id, old('igdb_cover_id', request()->igdb_cover_id)]),
            'igdb_url' => $helpers->firstNonEmpty([$game?->igdb_url, old('igdb_url', request()->igdb_url)]),
            'played_years' => $helpers->firstNonEmpty([$game?->played_years, old('played_years', request()->played_years)]),
            'comments' => $helpers->firstNonEmpty([$game?->comments, old('comments', request()->comments)]),
            'is_update' => $game instanceof \App\Models\Game,
            'form_route' => !$game instanceof \App\Models\Game ? route('games.store') : route('games.update', $game),
        ];
    }

    public function index()
    {
        $games = Game::all();

        return view('admin.games.index')->with('games', $games);
    }

    public function create()
    {
        return view('admin.games.form', $this->getFormData());
    }

    public function store(GameRequest $request)
    {
        $game = new Game();
        $game->fill($request->validated());
        $game->save();
        Session::flash('success', sprintf('%s added', $game->title));

        return Redirect::to(route('games.index'));
    }

    public function edit(Game $game)
    {
        return view('admin.games.form', $this->getFormData($game))->with('test', 'test');
    }

    public function update(GameRequest $request, Game $game)
    {
        $game->fill($request->validated());
        $game->save();
        Session::flash('success', sprintf('%s added', $game->title));

        return Redirect::to(route('games.index'));
    }

    public function destroy(Game $game)
    {
        dd('DEL');
    }
}
