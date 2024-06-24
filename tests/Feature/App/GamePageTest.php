<?php

use Inertia\Testing\AssertableInertia as Assert;

const GAME_URL = '/browse/game/%s';

describe('Game page - guest user', function () {
    test('is displayed', function () {
        $game = create_test_game(['is_sensitive' => false]);
        $this->get(sprintf(GAME_URL, $game->slug))->assertOk();
    });

    test('loads correct component', function () {
        $game = create_test_game(['is_sensitive' => false]);
        $this->get(sprintf(GAME_URL, $game->slug))->assertInertia(
            fn (Assert $page) => $page
                ->component('Game')
        );
    });

    test('sensitive game is not displayed', function () {
        $game = create_test_game(['is_sensitive' => true]);
        $this->get(sprintf(GAME_URL, $game->slug))->assertNotFound();
    });
});

describe('Game page - logged in user', function () {
    test('is displayed', function () {
        $game = create_test_game(['is_sensitive' => true]);
        $this->actingAs(create_test_user())
            ->get(sprintf(GAME_URL, $game->slug))
            ->assertOk();
    });

    test('loads correct component', function () {
        $game = create_test_game(['is_sensitive' => true]);
        $this->actingAs(create_test_user())
            ->get(sprintf(GAME_URL, $game->slug))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Game')
            );
    });

    test('sensitive game is displayed', function () {
        $game = create_test_game(['is_sensitive' => true]);
        $this->actingAs(create_test_user())
            ->get(sprintf(GAME_URL, $game->slug))
            ->assertOk();
    });
});
