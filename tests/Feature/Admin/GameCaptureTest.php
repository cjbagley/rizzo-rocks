<?php

use App\Models\Game;
use App\Models\GameCapture;
use App\Models\User;

function getCaptureUrl(Game $game, string $append = '') : string
{
    return sprintf('/admin/games/%s/captures', $game->slug) . $append;
}

test('capture index page is displayed', function () {
    $game = Game::factory()->create();
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(getCaptureUrl($game))
        ->assertOk();
});

test('capture can be added', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $capture = GameCapture::factory()->make();

    $response = $this
        ->actingAs($user)
        ->post(getCaptureUrl($game), [
            'title' => $capture->title,
            'type' => $capture->type,
            'href' => $capture->href,
            'comments' => $capture->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $saved_capture = GameCapture::where(['title' => $capture->title, 'game_id' => $game->id])->first();
    expect($capture->title)->toBe($saved_capture->title);
    expect($capture->type)->toBe($saved_capture->type);
    expect($capture->href)->toBe($saved_capture->href);
    expect($capture->comments)->toBe($saved_capture->comments);
});

test('capture can be edited', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $capture = GameCapture::factory()->create();
    $updated_capture = clone $capture;
    $updated_capture->title = fake()->name();

    $response = $this
        ->actingAs($user)
        ->put(route('captures.update', ['game' => $game, 'capture' => $updated_capture]), [
            'title' => $updated_capture->title,
            'type' => $capture->type,
            'href' => $capture->href,
            'comments' => $capture->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    $capture->refresh();

    expect($updated_capture->title)->toBe($capture->title);
    expect($updated_capture->href)->toBe($capture->href);
    expect($updated_capture->comments)->toBe($capture->comments);
    expect($updated_capture->type)->toBe($capture->type);
});

test('capture can be deleted', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $capture = GameCapture::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete(getCaptureUrl($game, "/{$capture->id}"))
        ->assertSessionHasNoErrors()
        ->assertRedirect(getCaptureUrl($game));

    expect(GameCapture::find($capture->id))->toBeEmpty();
});
