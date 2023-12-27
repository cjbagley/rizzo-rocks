<?php

namespace App\Http\Controllers;

use App\Api\Igdb;
use Inertia\Inertia;
use Inertia\Response;

class AppController
{
    public function index(): Response
    {
        return Inertia::render('Index');
    }

    public function twitch(): Response
    {
        return Inertia::render('Index');
    }

    public function games(): Response
    {
        $igdb = new Igdb();

        return Inertia::render('Games');
    }

    public function list(): Response
    {
        return Inertia::render('List');
    }
}
