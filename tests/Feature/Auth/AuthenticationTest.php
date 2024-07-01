<?php

use App\Providers\RouteServiceProvider;

test('login screen can be rendered', function () {
    $this
        ->get(RouteServiceProvider::LOGIN)
        ->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $response = $this->post(RouteServiceProvider::LOGIN, [
        'email' => create_test_user()->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::ADMIN_DASHBOARD);
});

test('users can not authenticate with invalid password', function () {
    $this->post(RouteServiceProvider::LOGIN, [
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
