<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;

class GameController extends AuthController
{
    public function index()
    {
        $games = Game::all();
        return view('admin.games.index')->with('games', $games);
    }

    public function create()
    {
        return view('admin.games.form');
    }

    public function store(GameRequest $request)
    {
        dd($request);
    }

    public function show(Game $game)
    {
        //
    }

    public function edit(Game $game)
    {
        //
    }

    public function update(GameRequest $request, Game $game)
    {
        //
    }

    public function destroy(Game $game)
    {
        //
    }
}
