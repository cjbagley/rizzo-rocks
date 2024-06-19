<?php

use App\Models\GameCapture;
use App\Models\Tag;
use Inertia\Testing\AssertableInertia as Assert;

const LIST_URL = '/browse/list';

// Not ideal, as this is still called before each test,
// but as far as I can find so far, there is no way to do
// this just once. beforeAll() would be ideal, but it can't
// call factories, so not possible.
beforeEach(function () {
    create_dummy_games_and_captures();
});

describe('List page', function () {
    test('is displayed', function () {
        $this->get(LIST_URL)->assertOk();
    });

    test('loaded correct component', function () {
        $this->get(LIST_URL)->assertInertia(
            fn (Assert $page) => $page
                ->component('List')
        );
    });

    test('displays pagination', function () {
        $response = $this->get(LIST_URL);
        $response->assertOk();
        $response->assertInertia(
            fn (Assert $page) => $page
                ->component('List', fn (Assert $page) => $page
                    ->has('pagination')
                ));
    });

    test('correct results when search parameter used', function () {
        $test_capture = GameCapture::all()->random(1)->first();
        $response = $this->get(sprintf('%s?search=%s', LIST_URL, $test_capture->title));

        $response->assertOk();

        $data = getListPageData($response);
        expect($data)->toHaveCount(1);

        $capture = $data[0];
        expect($capture)->toHaveKey('title')
            ->and($capture['title'])->toBe($test_capture->title);

        foreach ($capture['tags'] as $tag) {
            expect($tag['is_sensitive'])->toBeFalse();
        }
    });

    test('correct results when tag filtering used', function () {
        $tag = Tag::where('is_sensitive', '=', false)->first();

        $response = $this->get(sprintf('%s?tags=%s', LIST_URL, $tag->code));
        $response->assertOk();

        $data = getListPageData($response);
        $this->assertNotEmpty($data);

        foreach ($data as $capture) {
            $this->assertArrayHasKey('tags', $capture);
            $this->assertNotEmpty($capture['tags']);

            $tag_codes = collect($capture['tags'])->pluck('code')->toArray();
            expect($tag_codes)->toContain($tag['code']);
            foreach ($capture['tags'] as $tag) {
                expect($tag['is_sensitive'])->toBeFalse();
            }
        }
    });

    test('does not show sensitive game', function () {
        $response = $this->get(sprintf('%s?search=%s', LIST_URL, SENSITIVE_GAME_TITLE));
        $response->assertOk();

        expect(getListPageData($response))->toBeEmpty();
    });
});
