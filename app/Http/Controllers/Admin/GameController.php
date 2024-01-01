<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;

class GameController extends AuthController
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreGameRequest $request)
    {
        //
    }

    public function show(Game $game)
    {
        //
    }

    public function edit(Game $game)
    {
        //
    }

    public function update(UpdateGameRequest $request, Game $game)
    {
        //
    }

    public function destroy(Game $game)
    {
        //
    }
}
