<?php

namespace Tests\Feature\App;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_displayed(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_home_page_loads_index_component(): void
    {
        $this->get('/')->assertInertia(
            fn (Assert $page) => $page
                ->component('Index')
        );
    }
}
