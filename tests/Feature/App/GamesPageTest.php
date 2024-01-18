<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GamesPageTest extends TestCase
{
    use RefreshDatabase;

    const GAMES_URL = '/browse/games';

    public function test_games_page_is_displayed(): void
    {
        $this->get(self::GAMES_URL)->assertOk();
    }

    public function test_games_page_loads_games_component(): void
    {
        $this->get(self::GAMES_URL)->assertInertia(
            fn (Assert $page) => $page
                ->component('Games')
        );
    }
}
