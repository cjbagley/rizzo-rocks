<?php

namespace Tests\Feature\Api;

use App\Api\GameLookupService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class GameLookupServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_service_get_game_from_search(): void
    {
        try {
            $game_lookup = new GameLookupService();
            $data = $game_lookup->getGameDataFromSearch('Halo 5');
            $this->assertIsArray($data);
            $this->assertNotEmpty($data);

            $game = $data[0];
            $this->assertObjectHasProperty('name', $game);
            $cover_image_url = $game->getCoverImageUrl('t_thumb');
            $this->assertTrue(Str::isUrl($cover_image_url));
        } catch (Exception $e) {
            $this->assertSame('', $e->getMessage(), 'Exception was given');
        }
    }

    public function test_game_service_get_game_from_id(): void
    {
        try {
            $game_lookup = new GameLookupService();
            $game = $game_lookup->getGameDataFromId(6803);
            $this->assertIsObject($game);
            $this->assertNotEmpty($game);

            $this->assertObjectHasProperty('name', $game);
            $this->assertSame(Str::contains($game->name, 'Halo 5', false), true);
            $cover_image_url = $game->getCoverImageUrl('t_thumb');
            $this->assertTrue(Str::isUrl($cover_image_url));
        } catch (Exception $e) {
            $this->assertSame('', $e->getMessage(), 'Exception was given');
        }
    }
}
