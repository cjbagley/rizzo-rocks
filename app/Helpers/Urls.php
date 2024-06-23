<?php

namespace App\Helpers;

use App\Http\Controllers\AppController;

if (! function_exists('getSearchUrl')) {
    function getSearchUrl($term): string
    {
        return action([AppController::class, 'list'], ['search' => $term]);
    }
}

if (! function_exists('getTagFilterUrl')) {
    function getTagFilterUrl($tags): string
    {
        return action([AppController::class, 'list'], ['tags' => $tags]);
    }
}
