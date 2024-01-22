<?php

namespace Tests\Feature\Admin;

use App\Models\Game;
use App\Models\GameCapture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;

class GameCaptureTest extends TestCase
{
    use RefreshDatabase;

    final protected const CAPTURE_URL = '/admin/games/%s/captures';

    private function getCaptureUrl(Game $game, string $append = ''): string
    {
        return sprintf(self::CAPTURE_URL, $game->slug) . $append;
    }

    public function test_capture_index_page_is_displayed(): void
    {
        $game = Game::factory()->create();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get($this->getCaptureUrl($game));

        $response->assertOk();
    }

    public function test_capture_can_be_added(): void
    {
        $user = User::factory()->create();
        $game = Game::factory()->create();
        $capture = GameCapture::factory()->make();

        $response = $this
            ->actingAs($user)
            ->post($this->getCaptureUrl($game), [
                'title' => $capture->title,
                'type' => $capture->type,
                'href' => $capture->href,
                'comments' => $capture->comments,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect($this->getCaptureUrl($game));

        $saved_capture = GameCapture::where(['title' => $capture->title, 'game_id' => $game->id])->first();
        $this->assertSame($saved_capture->title, $capture->title);
        $this->assertSame($saved_capture->type, $capture->type);
        $this->assertSame($saved_capture->href, $capture->href);
        $this->assertSame($saved_capture->comments, $capture->comments);
    }

    public function test_capture_can_be_edited(): void
    {
        $user = User::factory()->create();
        $game = Game::factory()->create();
        $capture = GameCapture::factory()->create();
        $updated_capture = clone $capture;
        $updated_capture->title = fake()->name();

        $response = $this
            ->actingAs($user)
            ->put(sprintf($this->getCaptureUrl($game, "/{$capture->id}")), [
                'title' => $updated_capture->title,
                'type' => $capture->type,
                'href' => $capture->href,
                'comments' => $capture->comments,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::CAPTURE_URL);

        $capture->refresh();

        $this->assertSame($capture->title, $updated_capture->title);
        $this->assertSame($capture->href, $updated_capture->href);
        $this->assertSame($capture->comments, $updated_capture->comments);
        $this->assertSame($capture->type, $updated_capture->type);
    }

    public function test_capture_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $game = Game::factory()->create();
        $capture = GameCapture::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete($this->getCaptureUrl($game, "/{$capture->id}"));

        assertSame(GameCapture::find($capture->id), null);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(self::CAPTURE_URL);
    }
}
