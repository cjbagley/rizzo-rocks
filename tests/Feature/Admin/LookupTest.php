<?php

use App\Providers\RouteServiceProvider;

const ADMIN_LOOKUP_URL = 'admin/lookup';

guestUserTest(function () {
    test('cannot access lookup page', function () {
        $this
            ->get(ADMIN_LOOKUP_URL)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::LOGIN);
    });
});

loggedUserTest(function () {
    test('cannot access lookup page', function () {
        asLoggedUser()
            ->get(ADMIN_LOOKUP_URL)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::HOME);
    });
});

adminUserTest(function () {
    test('lookup page is displayed', function () {
        asAdmin()
            ->get(ADMIN_LOOKUP_URL)
            ->assertOk();
    });

    test('lookup search posts correctly', function () {
        asAdmin()
            ->post(ADMIN_LOOKUP_URL, [
                'search' => 'Halo 5',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('data')
            ->assertRedirect(ADMIN_LOOKUP_URL);
    });
});
