<?php

use App\Models\GameCapture;

it('Hides sensitive captures by default', function () {
    create_dummy_games_and_captures();
    foreach (GameCapture::all() as $capture) {
        foreach ($capture->tags as $tag) {
            expect($tag->is_sensitive)->toBeFalse();
        }
    }
});
