<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LookupTest extends TestCase
{
    use RefreshDatabase;
    const URL = 'admin/lookup';

    public function test_lookup_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(self::URL);

        $response->assertOk();
    }

    public function test_lookup_search_posts_correctly(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(self::URL, [
                'search' => 'Halo 5',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertSessionHas('data')
            ->assertRedirect(self::URL);
    }
}
