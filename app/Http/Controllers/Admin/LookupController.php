<?php

namespace App\Http\Controllers\Admin;

use App\Api\GameLookupService;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\LookupRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LookupController extends AuthController
{
    final protected const SEARCH_ROUTE = 'lookup.search';

    public function form(): View
    {
        return view('admin.lookup.lookup');
    }

    public function search(LookupRequest $request): RedirectResponse
    {
        $search = $request->validated('search');
        $search = htmlentities((string) $search, ENT_QUOTES, 'UTF-8');
        $data = [];
        $api_error = '';

        try {
            $game_lookup = new GameLookupService();
            $data = $game_lookup->getGameDataFromSearch($search);
        } catch (Exception $e) {
            $api_error = $e->getMessage();

            return Redirect::route(self::SEARCH_ROUTE)->with('api_error', $api_error);
        }

        return Redirect::route(self::SEARCH_ROUTE)->with('data', $data);
    }
}
