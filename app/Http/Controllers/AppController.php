<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AppController
{
    public function index(): Response
    {
        return Inertia::render('Index');
    }

    public function games(): Response
    {
        return Inertia::render('Games');
    }

    public function list(): Response
    {
        return Inertia::render('List');
    }
}
