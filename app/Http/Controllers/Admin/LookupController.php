<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController;
use Illuminate\View\View;

class LookupController extends AuthController
{
    public function form(): View
    {
        return view('admin.lookup.lookup');
    }
}
