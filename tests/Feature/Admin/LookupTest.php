<?php

use App\Models\User;

const ADMIN_LOOKUP_URL = 'admin/lookup';

test('lookup page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(ADMIN_LOOKUP_URL)
        ->assertOk();
});

test('lookup search posts correctly', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(ADMIN_LOOKUP_URL, [
            'search' => 'Halo 5',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('data')
        ->assertRedirect(ADMIN_LOOKUP_URL);
});
