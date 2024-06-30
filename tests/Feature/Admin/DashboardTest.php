<?php

describe('Guest user', function () {
    test('the dashboard page is not displayed', function () {
        $this
            ->get('/admin')
            ->assertStatus(302)
            ->assertRedirect('login');
    });
});

describe('Logged in user', function () {
    test('the dashboard page is displayed', function () {
        $this
            ->actingAs(create_test_user())
            ->get('/admin')
            ->assertStatus(302)
            ->assertRedirect('/');
    });
});

describe('Admin user', function () {

    test('the dashboard page is displayed', function () {
        $this
            ->actingAs(create_admin_user())
            ->get('/admin')
            ->assertOk();
    });
});
