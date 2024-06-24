<?php

use Inertia\Testing\AssertableInertia as Assert;

describe('Home page - guest user', function () {
    test('is displayed', function () {
        $this->get('/')->assertOk();
    });

    test('loads correct component', function () {
        $this->get('/')->assertInertia(
            fn (Assert $page) => $page
                ->component('Index')
        );
    });
});

describe('Home page - logged in user', function () {
    test('is displayed', function () {
        $this->actingAs(create_test_user())
            ->get('/')
            ->assertOk();
    });

    test('loads correct component', function () {
        $this->actingAs(create_test_user())
            ->get('/')
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Index')
            );
    });
});
