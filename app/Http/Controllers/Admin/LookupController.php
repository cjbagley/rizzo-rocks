<?php

namespace App\Http\Controllers\Admin;

use App\Api\GameLookupService;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\LookupRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class LookupController extends AuthController
{
    public function form(): View
    {
        return view('admin.lookup.lookup');
    }

    public function search(LookupRequest $request): RedirectResponse
    {
        $search = $request->validated('search');
        $search = htmlentities($search, ENT_QUOTES, 'UTF-8');
        $data = [];
        $api_error = '';

        try {
            $game_lookup = new GameLookupService();
            $data = $game_lookup->getGameData($search);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }
        return Redirect::route('lookup.search')
            ->with('data', $data)
            ->with('api_error', $api_error);
    }
}
