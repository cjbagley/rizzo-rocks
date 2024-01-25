<?php

use App\Models\Game;
use Inertia\Testing\AssertableInertia as Assert;

const GAME_URL = '/browse/game/%s';

test('game page is displayed', function () {
    $game = Game::factory()->create();
    $this->get(sprintf(GAME_URL, $game->slug))->assertOk();
});

test('game page loads game component', function () {
    $game = Game::factory()->create();
    $this->get(sprintf(GAME_URL, $game->slug))->assertInertia(
        fn (Assert $page) => $page
            ->component('Game')
    );
});
