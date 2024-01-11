<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;
    const GAME_URL = '/admin/games';

    public function test_game_index_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(self::GAME_URL);

        $response->assertOk();
    }

    public function test_game_can_be_added(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            #->patch(self::GAME_URL, [
            ->put(self::GAME_URL, [
                'title' => 'Halo 4',
                'played_years' => '2020',
                'igdb_id' => 123,
                'comments' => 'Here are some comments',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::GAME_URL);

        $user->refresh();

        #$this->assertSame('Test User', $user->name);
        #$this->assertSame('test@example.com', $user->email);
        #$this->assertNull($user->email_verified_at);
    }

    // public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    // {
    //     $user = User::factory()->create();
    //
    //     $response = $this
    //         ->actingAs($user)
    //         ->patch(self::GAME_URL, [
    //             'name' => 'Test User',
    //             'email' => $user->email,
    //         ]);
    //
    //     $response
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect(self::GAME_URL);
    //
    //     $this->assertNotNull($user->refresh()->email_verified_at);
    // }
    //
    // public function test_user_can_delete_their_account(): void
    // {
    //     $user = User::factory()->create();
    //
    //     $response = $this
    //         ->actingAs($user)
    //         ->delete(self::GAME_URL, [
    //             'password' => 'password',
    //         ]);
    //
    //     $response
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect('/');
    //
    //     $this->assertGuest();
    //     $this->assertNull($user->fresh());
    // }
    //
    // public function test_correct_password_must_be_provided_to_delete_account(): void
    // {
    //     $user = User::factory()->create();
    //
    //     $response = $this
    //         ->actingAs($user)
    //         ->from(self::GAME_URL)
    //         ->delete(self::GAME_URL, [
    //             'password' => 'wrong-password',
    //         ]);
    //
    //     $response
    //         ->assertSessionHasErrorsIn('userDeletion', 'password')
    //         ->assertRedirect(self::GAME_URL);
    //
    //     $this->assertNotNull($user->fresh());
    // }
}
