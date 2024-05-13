<?php

use App\Models\Game;
use App\Models\GameCapture;

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
    $capture = GameCapture::factory()->make();

    $this
        ->actingAs(create_test_user())
        ->post(getCaptureUrl($game), [
            'title' => $capture->title,
            'type' => $capture->type,
            'filekey' => $capture->filekey,
            'comments' => $capture->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $saved_capture = GameCapture::where(['title' => $capture->title, 'game_id' => $game->id])->first();
    expect($capture->title)->toBe($saved_capture->title);
    expect($capture->type)->toBe($saved_capture->type);
    expect($capture->filekey)->toBe($saved_capture->filekey);
    expect($capture->comments)->toBe($saved_capture->comments);
});

test('capture can be edited', function () {
    $game = create_test_game();
    $capture = GameCapture::factory()->create();
    $updated_capture = clone $capture;
    $updated_capture->title = fake()->name();

    $this
        ->actingAs(create_test_user())
        ->put(route('captures.update', ['game' => $game, 'capture' => $updated_capture]), [
            'title' => $updated_capture->title,
            'type' => $capture->type,
            'filekey' => $capture->filekey,
            'comments' => $capture->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $capture->refresh();

    expect($updated_capture->title)->toBe($capture->title);
    expect($updated_capture->filekey)->toBe($capture->filekey);
    expect($updated_capture->comments)->toBe($capture->comments);
    expect($updated_capture->type)->toBe($capture->type);
});

test('capture can be deleted', function () {
    $game = create_test_game();
    $capture = GameCapture::factory()->create();

    $this
        ->actingAs(create_test_user())
        ->delete(getCaptureUrl($game, '/'.$capture->id))
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    expect(GameCapture::find($capture->id))->toBeEmpty();
});
