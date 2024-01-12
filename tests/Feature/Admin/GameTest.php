<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Game;
use stdClass;

class GameTest extends TestCase
{
    use RefreshDatabase;
    const GAME_URL = '/admin/games';

    private function get_fake_game(): stdClass
    {
        $fake = new stdClass();
        $fake->title = fake()->name();
        $fake->igdb_id = fake()->randomNumber(1, 10000);
        $fake->played_years = fake()->words(3, true);
        $fake->comments = fake()->text();
        return  $fake;
    }

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
        $fake_game = $this->get_fake_game();
        $response = $this
            ->actingAs($user)
            ->post(self::GAME_URL, [
                'title' => $fake_game->title,
                'played_years' => $fake_game->played_years,
                'igdb_id' => $fake_game->igdb_id,
                'comments' => $fake_game->comments,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::GAME_URL);

        $saved_game = Game::where(['title' => $fake_game->title])->first();
        $this->assertSame($saved_game->title, $fake_game->title);
        $this->assertSame($saved_game->played_years, $fake_game->played_years);
        $this->assertSame($saved_game->igdb_id, $fake_game->igdb_id);
        $this->assertSame($saved_game->comments, $fake_game->comments);
    }
}
