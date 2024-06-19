<?php

use Inertia\Testing\AssertableInertia as Assert;

const GAMES_URL = '/browse/games';

/* See 'ListPageTest' comment for this */
beforeEach(function () {
    create_dummy_games_and_captures();
});

describe('Games page', function () {
    test('is displayed', function () {
        $this->get(GAMES_URL)->assertOk();
    });

    test('loads correct component and data', function () {
        $response = $this->get(GAMES_URL);
        $response->assertOk();
        $response->assertInertia(
            fn (Assert $page) => $page
                ->component('Games')
        );

        $games = getGamesPageData($response);
        expect($games)->not->toBeEmpty();
    });

    test('does not show sensitive game', function () {
        $response = $this->get(GAMES_URL);
        $response->assertOk();

        $games = getGamesPageData($response);
        expect($games)->not->toBeEmpty();

        foreach ($games as $game) {
            expect($game['title'])->not->toBe(SENSITIVE_GAME_TITLE);
        }
    });
});
