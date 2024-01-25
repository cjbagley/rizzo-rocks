<?php

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Str;

const ADMIN_GAME_URL = '/admin/games';

test('game index page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(ADMIN_GAME_URL)
        ->assertOk();
});

test('game can be added', function () {
    $user = User::factory()->create();
    $game = Game::factory()->make();
    $response = $this
        ->actingAs($user)
        ->post(ADMIN_GAME_URL, [
            'title' => $game->title,
            'played_years' => $game->played_years,
            'igdb_id' => $game->igdb_id,
            'igdb_cover_id' => $game->igdb_cover_id,
            'igdb_url' => $game->igdb_url,
            'comments' => $game->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_GAME_URL);

    $saved_game = Game::where(['title' => $game->title])->first();
    expect($saved_game->title)->toBe($game->title);
    expect($saved_game->played_years)->toBe($game->played_years);
    expect($saved_game->igdb_id)->toBe($game->igdb_id);
    expect($saved_game->comments)->toBe($game->comments);
    expect(Str::slug($saved_game->title))->toBe($saved_game->slug);
});

test('game can be edited', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();
    $original_game = clone $game;
    $updated_game = clone $game;
    $updated_game->title = fake()->name();

    $response = $this
        ->actingAs($user)
        ->put(sprintf('%s/%s', ADMIN_GAME_URL, $original_game->slug), [
            'title' => $updated_game->title,
            'played_years' => $original_game->played_years,
            'igdb_id' => $original_game->igdb_id,
            'igdb_cover_id' => $original_game->igdb_cover_id,
            'igdb_url' => $original_game->igdb_url,
            'comments' => $original_game->comments,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_GAME_URL);

    // Note - need to refresh here to get updated slug
    $updated_game->refresh();

    expect($original_game->title)->not->toBe($updated_game->title);
    expect($original_game->slug)->not->toBe($updated_game->slug);
    expect($updated_game->played_years)->toBe($original_game->played_years);
    expect($updated_game->igdb_id)->toBe($original_game->igdb_id);
    expect($updated_game->comments)->toBe($original_game->comments);
    expect(Str::slug($updated_game->title))->toBe($updated_game->slug);
});

test('game can be deleted', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete(route('games.destroy', $game))
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_GAME_URL);

    expect(Game::find($game->id))->toBeNull();
});
