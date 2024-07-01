<?php

use App\Models\Game;
use App\Models\GameCapture;
use App\Models\Tag;
use App\Providers\RouteServiceProvider;

function getCaptureUrl(Game $game, string $append = ''): string
{
    return sprintf('/admin/games/%s/captures', $game->slug).$append;
}

guestUserTest(function () {
    test('cannot access capture index page', function () {
        $this
            ->get(getCaptureUrl(create_test_game()))
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::LOGIN);
    });
});

loggedUserTest(function () {
    test('cannot access capture index page', function () {
        asLoggedUser()
            ->get(getCaptureUrl(create_test_game()))
            ->assertFound()
            ->assertRedirect(RouteServiceProvider::HOME);
    });
});

adminUserTest(function () {
    test('capture index page is displayed', function () {
        asAdmin()
            ->get(getCaptureUrl(create_test_game()))
            ->assertOk();
    });

    test('capture can be added', function () {
        $game = create_test_game();
        $tags = Tag::factory()->count(5)->create();
        $capture = GameCapture::factory()->for($game)->make();
        $selected_tags = $tags->random(2)->pluck('id')->toArray();

        asAdmin()
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
        expect($capture->title)->toBe($saved_capture->title)
            ->and($capture->type)->toBe($saved_capture->type)
            ->and($capture->filekey)->toBe($saved_capture->filekey)
            ->and($capture->comments)->toBe($saved_capture->comments)
            ->and($capture->game_id)->toBe($saved_capture->game_id)
            ->and($saved_capture->tags->count())->toBe(2);
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

        asAdmin()
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

        expect($updated_capture->title)->toBe($capture->title)
            ->and($updated_capture->filekey)->toBe($capture->filekey)
            ->and($updated_capture->comments)->toBe($capture->comments)
            ->and($updated_capture->type)->toBe($capture->type)
            ->and($updated_capture->game_id)->toBe($game->id)
            ->and($updated_capture->game_id)->toBe($capture->game_id)
            ->and($capture->tags->count())->toBe(3);
        foreach ($capture->tags as $tag) {
            expect($tag->id)->toBeIn($selected_tags);
        }
    });

    test('capture can be deleted', function () {
        $game = create_test_game();
        $capture = GameCapture::factory()->for($game)->create();

        asAdmin()
            ->delete(getCaptureUrl($game, '/'.$capture->id))
            ->assertSessionHasNoErrors()
            ->assertRedirect(getCaptureUrl($game));

        expect(GameCapture::find($capture->id))->toBeEmpty();
    });
});
