<?php

use App\Models\Game;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Str;

const ADMIN_GAME_URL = '/admin/games';

guestUserTest(function () {
    test('cannot access game index page', function () {
        $this
            ->get(ADMIN_GAME_URL)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::LOGIN);
    });
});

loggedUserTest(function () {
    test('cannot access game index page', function () {
        asLoggedUser()
            ->get(ADMIN_GAME_URL)
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::HOME);
    });
});

adminUserTest(function () {
    test('game index page is displayed', function () {
        asAdmin()
            ->get(ADMIN_GAME_URL)
            ->assertOk();
    });

    test('game can be added', function () {
        $game = Game::factory()->make();

        asAdmin()
            ->post(ADMIN_GAME_URL, [
                'title' => $game->title,
                'played_years' => $game->played_years,
                'igdb_id' => $game->igdb_id,
                'igdb_cover_id' => $game->igdb_cover_id,
                'igdb_url' => $game->igdb_url,
                'comments' => $game->comments,
                'is_sensitive' => $game->is_sensitive,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(ADMIN_GAME_URL);

        $saved_game = Game::where(['title' => $game->title])->first();
        expect($saved_game->title)->toBe($game->title)
            ->and($saved_game->played_years)->toBe($game->played_years)
            ->and($saved_game->igdb_id)->toBe($game->igdb_id)
            ->and($saved_game->comments)->toBe($game->comments)
            ->and($saved_game->is_sensitive)->toBe($game->is_sensitive)
            ->and(Str::slug($saved_game->title))->toBe($saved_game->slug);
    });

    test('game can be edited', function () {
        $original_game = create_test_game(['is_sensitive' => false]);
        $updated_game = clone $original_game;

        asAdmin()
            ->put(sprintf('%s/%s', ADMIN_GAME_URL, $original_game->slug), [
                'title' => fake()->name(),
                'played_years' => $original_game->played_years,
                'igdb_id' => $original_game->igdb_id,
                'igdb_cover_id' => $original_game->igdb_cover_id,
                'igdb_url' => $original_game->igdb_url,
                'comments' => $original_game->comments,
                'is_sensitive' => true,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(ADMIN_GAME_URL);

        // Note - need to refresh here to get updated slug
        $updated_game->refresh();

        expect($original_game->title)->not->toBe($updated_game->title)
            ->and($original_game->slug)->not->toBe($updated_game->slug)
            ->and($original_game->is_sensitive)->not->toBe($updated_game->is_sensitive)
            ->and($updated_game->played_years)->toBe($original_game->played_years)
            ->and($updated_game->igdb_id)->toBe($original_game->igdb_id)
            ->and($updated_game->comments)->toBe($original_game->comments)
            ->and(Str::slug($updated_game->title))->toBe($updated_game->slug);
    });

    test('game can be deleted', function () {
        $game = create_test_game();

        asAdmin()
            ->delete(route('games.destroy', $game))
            ->assertSessionHasNoErrors()
            ->assertRedirect(ADMIN_GAME_URL);

        expect(Game::find($game->id))->toBeNull();
    });
});
