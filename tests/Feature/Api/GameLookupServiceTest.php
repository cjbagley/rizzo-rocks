<?php

namespace Tests\Feature\Api;

use App\Api\GameLookupService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class GameLookupServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_service_get_game(): void
    {
        define("DEBUG_ERRORS", true);
        try {
            $game_lookup = new GameLookupService();
            $data = $game_lookup->getGameData('Halo 5');
            $this->assertIsArray($data);
            $this->assertNotEmpty($data);

            $game = $data[0];
            $this->assertObjectHasProperty('name', $game);
            $cover_image_url = $game->getCoverImageUrl('t_thumb');
            $this->assertTrue(Str::isUrl($cover_image_url));
        } catch (Exception $e) {
            $this->assertSame('', $e->getMessage(), "Exception was given");
        }
    }
}
