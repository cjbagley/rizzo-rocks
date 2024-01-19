<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\StoreGameCaptureRequest;
use App\Http\Requests\UpdateGameCaptureRequest;
use App\Models\Game;
use App\Models\GameCapture;

class GameCaptureController extends AuthController
{
    public function index(Game $game)
    {
        dd("HERE");
    }

    public function create()
    {
        //
    }

    public function store(StoreGameCaptureRequest $request)
    {
        //
    }

    public function edit(GameCapture $gameCapture)
    {
        //
    }

    public function update(UpdateGameCaptureRequest $request, GameCapture $gameCapture)
    {
        //
    }

    public function destroy(GameCapture $gameCapture)
    {
        //
    }
}
