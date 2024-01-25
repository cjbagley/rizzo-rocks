<?php

use App\Providers\RouteServiceProvider;

test('login screen can be rendered', function () {
    $this
        ->get('/login')
        ->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $response = $this->post('/login', [
        'email' => create_test_user()->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $this->post('/login', [
        'email' => create_test_user()->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $response = $this->actingAs(create_test_user())->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
