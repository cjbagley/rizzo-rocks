<?php

const ADMIN_LOOKUP_URL = 'admin/lookup';

test('lookup page is displayed', function () {
    $this
        ->actingAs(create_test_user())
        ->get(ADMIN_LOOKUP_URL)
        ->assertOk();
});

test('lookup search posts correctly', function () {
    $this
        ->actingAs(create_test_user())
        ->post(ADMIN_LOOKUP_URL, [
            'search' => 'Halo 5',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('data')
        ->assertRedirect(ADMIN_LOOKUP_URL);
});
