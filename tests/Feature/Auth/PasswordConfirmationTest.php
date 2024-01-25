<?php

test('confirm password screen can be rendered', function () {
    $this
        ->actingAs(create_test_user())
        ->get('/confirm-password')
        ->assertStatus(200);
});

test('password can be confirmed', function () {
    $this
        ->actingAs(create_test_user())
        ->post('/confirm-password', [
            'password' => 'password',
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $this
        ->actingAs(create_test_user())
        ->post('/confirm-password', [
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrors();
});
