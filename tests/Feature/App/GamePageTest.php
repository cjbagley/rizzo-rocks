<?php

namespace Tests\Feature\App;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GamePageTest extends TestCase
{
    use RefreshDatabase;

    const GAME_URL = '/browse/game/%s';

    public function test_game_page_is_displayed(): void
    {
        $game = Game::factory()->create();
        $this->get(sprintf(self::GAME_URL, $game->slug))->assertOk();
    }

    public function test_game_page_loads_game_component(): void
    {
        $game = Game::factory()->create();
        $this->get(sprintf(self::GAME_URL, $game->slug))->assertInertia(
            fn (Assert $page) => $page
                ->component('Game')
        );
    }
}
