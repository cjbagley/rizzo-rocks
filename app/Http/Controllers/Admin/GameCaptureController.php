<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GameCaptureType;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\GameCaptureRequest;
use App\Models\Game;
use App\Models\GameCapture;
use App\Helpers\Helpers;

class GameCaptureController extends AuthController
{
    private const ROUTE = 'games.index';

    private function getFormData(Game $game, ?GameCapture $capture = null): array
    {
        $helpers = new Helpers();
        $is_update = $capture instanceof \App\Models\GameCapture && $capture->exists;

        return [
            'title' => $helpers->firstNonEmpty([$capture?->title, old('title', request()->title)]),
            'comments' => $helpers->firstNonEmpty([$capture?->comments, old('comments', request()->comments)]),
            'href' => $helpers->firstNonEmpty([$capture?->href, old('href', request()->href)]),
            'type' => $helpers->firstNonEmpty([$capture?->type, old('type', request()->type)]),
            'types' => [
                ['text' => GameCaptureType::Image->name, 'value' => GameCaptureType::Image->value],
                ['text' => GameCaptureType::Video->name, 'value' => GameCaptureType::Video->value],
            ],
            'is_update' => $is_update,
            'form_route' => $is_update ? route('captures.update', ['game' => $game, 'capture' => $capture]) : route('captures.store', $game),
        ];
    }

    public function index(Game $game)
    {
        return view('admin.captures.index')->with(['game' => $game]);
    }

    public function create(Game $game)
    {
        return view('admin.captures.form', $this->getFormData($game));
    }

    public function store(GameCaptureRequest $request)
    {
        dd($request->all());
    }

    public function edit(GameCapture $capture)
    {
        //
    }

    public function update(GameCaptureRequest $request, GameCapture $capture)
    {
        //
    }

    public function destroy(GameCapture $capture)
    {
        //
    }
}
