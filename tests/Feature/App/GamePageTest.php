<?php

use Inertia\Testing\AssertableInertia as Assert;

const GAME_URL = '/browse/game/%s';

test('game page is displayed', function () {
    $game = create_test_game(['is_sensitive' => false]);
    $this->get(sprintf(GAME_URL, $game->slug))->assertOk();
});

test('Sensitive game is not displayed', function () {
    $game = create_test_game(['is_sensitive' => true]);
    $this->get(sprintf(GAME_URL, $game->slug))->assertNotFound();
});

test('game page loads game component', function () {
    $game = create_test_game(['is_sensitive' => false]);
    $this->get(sprintf(GAME_URL, $game->slug))->assertInertia(
        fn (Assert $page) => $page
            ->component('Game')
    );
});
