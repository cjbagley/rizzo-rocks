<?php

namespace App\Helpers;

class SharedViewData
{
    // For use with Svelte view rendering
    public static function get(): array
    {
        return [
            'appName' => config('app.name'),
            'gameBrowse' => __('app.game.browse'),
            'gameList' => __('app.game.list'),
            'noResults' => __('app.no_results_found'),
        ];
    }
}
