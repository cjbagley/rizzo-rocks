<?php

use App\Enums\ImageSize;
use App\Models\Game;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('gets cover url', function () {
    $expected_thumb = 'https://images.igdb.com/igdb/image/upload/t_thumb/abcde.jpg';
    $expected_cover_small = 'https://images.igdb.com/igdb/image/upload/t_cover_small/abcde.jpg';
    $expected_cover_big = 'https://images.igdb.com/igdb/image/upload/t_cover_big/abcde.jpg';
    $expected_seven_twenty_p = 'https://images.igdb.com/igdb/image/upload/t_720p/abcde.jpg';
    $game = Game::factory()->create(['igdb_cover_id' => 'abcde']);

    expect($game->getCoverImageUrl(ImageSize::Thumb, false))->toBe($expected_thumb);
    expect($game->getCoverImageUrl(ImageSize::Cover_small, false))->toBe($expected_cover_small);
    expect($game->getCoverImageUrl(ImageSize::Cover_big, false))->toBe($expected_cover_big);
    expect($game->getCoverImageUrl(ImageSize::Seven_twenty_p, false))->toBe($expected_seven_twenty_p);
});

it('gets retina cover url', function () {
    $expected_thumb = 'https://images.igdb.com/igdb/image/upload/t_thumb_2x/abcde.jpg';
    $expected_cover_small = 'https://images.igdb.com/igdb/image/upload/t_cover_small_2x/abcde.jpg';
    $expected_cover_big = 'https://images.igdb.com/igdb/image/upload/t_cover_big_2x/abcde.jpg';
    $expected_seven_twenty_p = 'https://images.igdb.com/igdb/image/upload/t_720p_2x/abcde.jpg';
    $game = Game::factory()->create(['igdb_cover_id' => 'abcde']);

    expect($game->getCoverImageUrl(ImageSize::Thumb, true))->toBe($expected_thumb);
    expect($game->getCoverImageUrl(ImageSize::Cover_small, true))->toBe($expected_cover_small);
    expect($game->getCoverImageUrl(ImageSize::Cover_big, true))->toBe($expected_cover_big);
    expect($game->getCoverImageUrl(ImageSize::Seven_twenty_p, true))->toBe($expected_seven_twenty_p);
});
