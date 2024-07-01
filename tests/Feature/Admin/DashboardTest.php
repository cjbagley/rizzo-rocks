<?php

use App\Providers\RouteServiceProvider;

guestUserTest(function () {
    test('cannot access', function () {
        $this
            ->get(RouteServiceProvider::ADMIN_DASHBOARD)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::LOGIN);
    });
});

loggedUserTest(function () {
    test('cannot access', function () {
        asLoggedUser()
            ->get(RouteServiceProvider::ADMIN_DASHBOARD)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::HOME);
    });
});

adminUserTest(function () {
    test('the dashboard page is displayed', function () {
        asAdmin()
            ->get(RouteServiceProvider::ADMIN_DASHBOARD)
            ->assertOk()
            ->assertViewIs('admin.dashboard');
    });
});
