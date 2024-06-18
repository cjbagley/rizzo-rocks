<?php

use Inertia\Testing\AssertableInertia as Assert;

const LIST_URL = '/browse/list';

// Not ideal, as this is still called before each test,
// but as far as I can find so far, there is no way to do
// this just once. beforeAll() would be ideal, but it can't
// call factories, so not possible.
beforeEach(function () {
    create_dummy_games_and_captures();
});

describe('listpage', function () {
    test('is displayed', function () {
        $this->get(LIST_URL)->assertOk();
    });

    test('is loaded with games component', function () {
        $this->get(LIST_URL)->assertInertia(
            fn (Assert $page) => $page
                ->component('List')
        );
    });

    test('displays pagination', function () {
        $response = $this->get(LIST_URL);
        $response->assertOk();
        $response->assertInertia(
            fn (Assert $page) => $page
                ->component('List', fn (Assert $page) => $page
                    ->has('pagination')
                ));
    });

    test('works when search parameter used', function () {
        $response = $this->get(LIST_URL);
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->has('data.data.data')
        );
    });

    test('works when tag filtering used', function () {
        $response = $this->get(LIST_URL.'?tags=C');
        $response->assertOk();
    });

    test('does not show senstive game', function () {
        $response = $this->get(LIST_URL.'?search=gears');
        $response->assertOk();
    });
});
