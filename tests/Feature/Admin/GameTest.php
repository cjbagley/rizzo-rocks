<?php

namespace Tests\Feature\Admin;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertSame;

class GameTest extends TestCase
{
    use RefreshDatabase;

    final protected const GAME_URL = '/admin/games';

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
        $game = Game::factory()->create();
        $response = $this
            ->actingAs($user)
            ->post(self::GAME_URL, [
                'title' => $game->title,
                'played_years' => $game->played_years,
                'igdb_id' => $game->igdb_id,
                'igdb_cover_id' => $game->igdb_cover_id,
                'igdb_url' => $game->igdb_url,
                'comments' => $game->comments,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::GAME_URL);

        $saved_game = Game::where(['title' => $game->title])->first();
        $this->assertSame($saved_game->title, $game->title);
        $this->assertSame($saved_game->played_years, $game->played_years);
        $this->assertSame($saved_game->igdb_id, $game->igdb_id);
        $this->assertSame($saved_game->comments, $game->comments);
        $this->assertSame($saved_game->slug, Str::slug($game->title));
    }

    public function test_game_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $game = Game::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('games.destroy', $game));

        assertSame(Game::find($game->id), null);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::GAME_URL);
    }
}
