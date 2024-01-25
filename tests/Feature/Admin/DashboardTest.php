<?php

test('the dashboard page is displayed', function () {
    $this
        ->actingAs(create_test_user())
        ->get('/admin')
        ->assertOk();
});
