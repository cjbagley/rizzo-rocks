<?php

use Inertia\Testing\AssertableInertia as Assert;

const GAMES_URL = '/browse/games';

test('games page is displayed', function () {
    $this->get(GAMES_URL)->assertOk();
});

test('games page loads games component', function () {
    $this->get(GAMES_URL)->assertInertia(
        fn (Assert $page) => $page
            ->component('Games')
    );
});
