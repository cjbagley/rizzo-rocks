<?php

use App\Models\Game;
use App\Models\GameCapture;
use App\Models\Tag;

function getCaptureUrl(Game $game, string $append = ''): string
{
    return sprintf('/admin/games/%s/captures', $game->slug).$append;
}

test('capture index page is displayed', function () {
    $game = create_test_game();

    $this
        ->actingAs(create_test_user())
        ->get(getCaptureUrl($game))
        ->assertOk();
});

test('capture can be added', function () {
    $game = create_test_game();
    $tags = Tag::factory()->count(5)->create();
    $capture = GameCapture::factory()->for($game)->make();
    $selected_tags = $tags->random(2)->pluck('id')->toArray();

    $this
        ->actingAs(create_test_user())
        ->post(getCaptureUrl($game), [
            'title' => $capture->title,
            'type' => $capture->type,
            'filekey' => $capture->filekey,
            'comments' => $capture->comments,
            'tags' => $selected_tags,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $saved_capture = GameCapture::where(['title' => $capture->title, 'game_id' => $game->id])->first();
    expect($capture->title)->toBe($saved_capture->title);
    expect($capture->type)->toBe($saved_capture->type);
    expect($capture->filekey)->toBe($saved_capture->filekey);
    expect($capture->comments)->toBe($saved_capture->comments);
    expect($capture->game_id)->toBe($saved_capture->game_id);
    expect($saved_capture->tags->count())->toBe(2);
    foreach ($saved_capture->tags as $tag) {
        expect($tag->id)->toBeIn($selected_tags);
    }
});

test('capture can be edited', function () {
    $game = create_test_game();
    $tags = Tag::factory()->count(5)->create();
    $capture = GameCapture::factory()->for($game)->create();
    $updated_capture = clone $capture;
    $updated_capture->title = fake()->name();
    $selected_tags = $tags->random(3)->pluck('id')->toArray();

    $this
        ->actingAs(create_test_user())
        ->put(route('captures.update', ['game' => $game, 'capture' => $updated_capture]), [
            'title' => $updated_capture->title,
            'type' => $capture->type,
            'filekey' => $capture->filekey,
            'comments' => $capture->comments,
            'tags' => $selected_tags,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $capture->refresh();

    expect($updated_capture->title)->toBe($capture->title);
    expect($updated_capture->filekey)->toBe($capture->filekey);
    expect($updated_capture->comments)->toBe($capture->comments);
    expect($updated_capture->type)->toBe($capture->type);
    expect($updated_capture->game_id)->toBe($game->id);
    expect($updated_capture->game_id)->toBe($capture->game_id);
    expect($capture->tags->count())->toBe(3);
    foreach ($capture->tags as $tag) {
        expect($tag->id)->toBeIn($selected_tags);
    }
});

test('capture can be deleted', function () {
    $game = create_test_game();
    $capture = GameCapture::factory()->for($game)->create();

    $this
        ->actingAs(create_test_user())
        ->delete(getCaptureUrl($game, '/'.$capture->id))
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    expect(GameCapture::find($capture->id))->toBeEmpty();
});
