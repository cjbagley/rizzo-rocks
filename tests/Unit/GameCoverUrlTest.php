<?php

namespace Tests\Unit;

use App\Enums\ImageSize;
use Tests\TestCase;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameCoverUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_cover_url(): void
    {
        $expected_thumb = "https://images.igdb.com/igdb/image/upload/t_thumb/abcde.jpg";
        $expected_cover_small = "https://images.igdb.com/igdb/image/upload/t_cover_small/abcde.jpg";
        $expected_cover_big = "https://images.igdb.com/igdb/image/upload/t_cover_big/abcde.jpg";
        $expected_seven_twenty_p = "https://images.igdb.com/igdb/image/upload/t_720p/abcde.jpg";
        $game = Game::factory()->create(['igdb_cover_id' => 'abcde']);

        $this->assertSame($game->getCoverImageUrl(ImageSize::Thumb), $expected_thumb);
        $this->assertSame($game->getCoverImageUrl(ImageSize::Cover_small), $expected_cover_small);
        $this->assertSame($game->getCoverImageUrl(ImageSize::Cover_big), $expected_cover_big);
        $this->assertSame($game->getCoverImageUrl(ImageSize::Seven_twenty_p), $expected_seven_twenty_p);
    }
}
