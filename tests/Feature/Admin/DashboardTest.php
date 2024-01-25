<?php

use App\Models\User;

test('the dashboard page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin')
        ->assertOk();
});
