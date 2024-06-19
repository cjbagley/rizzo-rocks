<?php

use App\Models\Game;

it('Hides sensitive games by default', function () {
    create_dummy_games_and_captures();
    foreach (Game::all() as $game) {
        expect($game->is_sensitive)->toBeFalse();
        foreach ($game->captures as $capture) {
            foreach ($capture->tags as $tag) {
                expect($tag->is_sensitive)->toBeFalse();
            }
        }
    }
});
