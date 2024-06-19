<?php

use Inertia\Testing\AssertableInertia as Assert;

describe('Home page', function () {
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
