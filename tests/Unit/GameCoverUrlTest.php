<?php

use App\Enums\ImageSize;
use App\Models\Game;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('gets cover url', function () {
    $expected_thumb = "https://images.igdb.com/igdb/image/upload/t_thumb/abcde.jpg";
    $expected_cover_small = "https://images.igdb.com/igdb/image/upload/t_cover_small/abcde.jpg";
    $expected_cover_big = "https://images.igdb.com/igdb/image/upload/t_cover_big/abcde.jpg";
    $expected_seven_twenty_p = "https://images.igdb.com/igdb/image/upload/t_720p/abcde.jpg";
    $game = Game::factory()->create(['igdb_cover_id' => 'abcde']);

    expect($game->getCoverImageUrl(ImageSize::Thumb))->toBe($expected_thumb);
    expect($game->getCoverImageUrl(ImageSize::Cover_small))->toBe($expected_cover_small);
    expect($game->getCoverImageUrl(ImageSize::Cover_big))->toBe($expected_cover_big);
    expect($game->getCoverImageUrl(ImageSize::Seven_twenty_p))->toBe($expected_seven_twenty_p);
});
