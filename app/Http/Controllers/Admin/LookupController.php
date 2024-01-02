<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Admin\LookupRequest;
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
        return Redirect::route('lookup.search')->with('data', 'API data go here');
    }
}
