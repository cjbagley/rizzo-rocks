<?php

namespace Tests\Feature;

use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class DarkModeTest extends TestCase
{
    public function test_dark_mode_works(): void
    {
        $this->get('/')->assertInertia(
            fn (Assert $page) => $page
                ->component('Index')->where()
        );
    }
}
