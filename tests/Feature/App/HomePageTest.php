<?php

use Inertia\Testing\AssertableInertia as Assert;

test('home page is displayed', function () {
    $this->get('/')->assertOk();
});

test('home page loads index component', function () {
    $this->get('/')->assertInertia(
        fn (Assert $page) => $page
            ->component('Index')
    );
});
