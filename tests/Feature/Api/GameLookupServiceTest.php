<?php

use App\Api\GameLookupService;
use Illuminate\Support\Str;

test('game service get game from search', function () {
    try {
        $game_lookup = new GameLookupService();
        $data = $game_lookup->getGameDataFromSearch('Halo 5');
        expect($data)->toBeArray();
        expect($data)->not->toBeEmpty();

        $game = $data[0];
        $this->assertObjectHasProperty('name', $game);
        $cover_image_url = $game->getCoverImageUrl('t_thumb');
        expect(Str::isUrl($cover_image_url))->toBeTrue();
    } catch (Exception $exception) {
        expect($exception->getMessage())->toBe('', 'Exception was given');
    }
});

test('game service get game from id', function () {
    try {
        $game_lookup = new GameLookupService();
        $game = $game_lookup->getGameDataFromId(6803);
        expect($game)->toBeObject();
        expect($game)->not->toBeEmpty();

        $this->assertObjectHasProperty('name', $game);
        expect(true)->toBe(Str::contains($game->name, 'Halo 5', false));
        $cover_image_url = $game->getCoverImageUrl('t_thumb');
        expect(Str::isUrl($cover_image_url))->toBeTrue();
    } catch (Exception $exception) {
        expect($exception->getMessage())->toBe('', 'Exception was given');
    }
});
