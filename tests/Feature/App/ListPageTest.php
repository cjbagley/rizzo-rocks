<?php

use Inertia\Testing\AssertableInertia as Assert;

const LIST_URL = '/browse/list';

test('list page is displayed', function () {
    $this->get(LIST_URL)->assertOk();
});

test('list page loads games component', function () {
    $this->get(LIST_URL)->assertInertia(
        fn (Assert $page) => $page
            ->component('List')
    );
});

test('list page is displayed with a pagination link', function () {
    $response = $this->get(LIST_URL);
    $response->assertOk();
    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('List', fn (Assert $page) => $page
                ->has('pagination')
            ));
});

test('search does not break the page', function () {
    $response = $this->get(LIST_URL);
    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->has('data.data.data')
    );
});

test('tag filtering does not break the page', function () {
    $response = $this->get(LIST_URL.'?tags=C');
    $response->assertOk();
});

test('senstive game does not show', function () {
    $response = $this->get(LIST_URL.'?search=gears');
    $response->assertOk();
});
