<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GameCaptureType;
use App\Helpers\Helpers;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\GameCaptureRequest;
use App\Models\Game;
use App\Models\GameCapture;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GameCaptureController extends AuthController
{
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
        return view('admin.captures.index')->with(['game' => $game, 'header' => 'Captures']);
    }

    public function create(Game $game)
    {
        return view('admin.captures.form', $this->getFormData($game));
    }

    public function store(GameCaptureRequest $request, Game $game)
    {
        $capture = new GameCapture();
        $capture->fill($request->validated());

        $capture->game_id = $game->id;
        $capture->save();

        Session::flash('success', sprintf('%s added', $capture->title));

        return Redirect::to(route('captures.index', $game));
    }

    public function edit(Game $game, GameCapture $capture)
    {
        return view('admin.captures.form', $this->getFormData($game, $capture));
    }

    public function update(GameCaptureRequest $request, Game $game, GameCapture $capture)
    {
        $capture->fill($request->validated());
        $capture->save();
        Session::flash('success', sprintf('%s added', $capture->title));

        return Redirect::to(route('captures.index', $game));
    }

    public function destroy(Game $game, GameCapture $capture)
    {
        $capture->delete();
        Session::flash('success', sprintf('%s deleted', $capture->title));

        return Redirect::to(route('captures.index', $game));
    }
}
