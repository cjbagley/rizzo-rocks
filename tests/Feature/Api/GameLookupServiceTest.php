<?php

namespace Tests\Feature\App;

use App\Api\GameLookupService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
            $this->assertThat($data[0], $this->arrayHasKey('name'));
        } catch (Exception $e) {
            $this->assertSame('', $e->getMessage(), "Exception was given");
        }
    }
}
