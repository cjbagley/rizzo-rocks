<?php

use App\Models\User;

const ADMIN_PROFILE_URL = '/admin/profile';

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(ADMIN_PROFILE_URL)
        ->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(ADMIN_PROFILE_URL, [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_PROFILE_URL);

    $user->refresh();

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(ADMIN_PROFILE_URL, [
            'name' => 'Test User',
            'email' => $user->email,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_PROFILE_URL);

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete(ADMIN_PROFILE_URL, [
            'password' => 'password',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    expect($user->fresh())->toBeNull();
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(ADMIN_PROFILE_URL)
        ->delete(ADMIN_PROFILE_URL, [
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect(ADMIN_PROFILE_URL);

    expect($user->fresh())->not->toBeNull();
});
