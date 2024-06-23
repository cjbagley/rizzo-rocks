<?php

use App\Models\GameCapture;
use App\Models\Scopes\SensitiveTagScope;
use App\Models\Tag;
use Inertia\Testing\AssertableInertia as Assert;

use function App\Helpers\getSearchUrl;
use function App\Helpers\getTagFilterUrl;

const LIST_URL = '/browse/list';

// Not ideal, as this is still called before each test,
// but as far as I can find so far, there is no way to do
// this just once. beforeAll() would be ideal, but it can't
// call factories, so not possible.
beforeEach(function () {
    create_dummy_games_and_captures();
});

describe('List page - guest user', function () {
    test('is displayed', function () {
        $this->get(LIST_URL)
            ->assertOk();
    });

    test('loaded correct component', function () {
        $this->get(LIST_URL)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('List')
            );
    });

    test('displays pagination', function () {
        $this->get(LIST_URL)
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('List', fn (Assert $page) => $page
                        ->has('pagination')
                    ));
    });

    test('correct results when search parameter used', function () {
        $test_capture = GameCapture::all()->random(1)->first();
        $response = $this->get(getSearchUrl($test_capture->title));

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
        $test_tag = Tag::where('is_sensitive', '=', false)->first();

        $response = $this->get(getTagFilterUrl($test_tag->code));
        $response->assertOk();

        $data = getListPageData($response);
        expect($data)->not()->toBeEmpty();

        foreach ($data as $capture) {
            expect($capture)->toHaveKey('tags');
            expect($capture['tags'])->not()->toBeEmpty();

            $tag_codes = collect($capture['tags'])->pluck('code')->toArray();
            expect($tag_codes)->toContain($test_tag->code);
            foreach ($capture['tags'] as $tag) {
                expect($tag['is_sensitive'])->toBeFalse();
            }
        }
    });

    test('does not see sensitive game', function () {
        $response = $this->get(getSearchUrl(SENSITIVE_GAME_TITLE));
        $response->assertOk();

        expect(getListPageData($response))->toBeEmpty();
    });
});

describe('List page - logged in user', function () {
    test('is displayed', function () {
        $this->actingAs(create_test_user())
            ->get(LIST_URL)
            ->assertOk();
    });

    test('loaded correct component', function () {
        $this->actingAs(create_test_user())
            ->get(LIST_URL)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('List')
            );
    });

    test('displays pagination', function () {
        $this->actingAs(create_test_user())
            ->get(LIST_URL)
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('List', fn (Assert $page) => $page
                        ->has('pagination')
                    ));
    });

    test('can see sensitive game', function () {
        $response = $this
            ->actingAs(create_test_user())
            ->get(getSearchUrl(SENSITIVE_GAME_TITLE));
        $response->assertOk();

        $data = getListPageData($response);
        expect($data)->not()->toBeEmpty();

        foreach ($data as $capture) {
            expect($capture['game'])->toBe(SENSITIVE_GAME_TITLE);
        }
    });

    test('can see sensitive results when tag filtering used', function () {
        $test_tag = Tag::withoutGlobalScope(SensitiveTagScope::class)
            ->where('is_sensitive', '=', true)
            ->first();

        // Really just in case scoping does something unexpected
        expect($test_tag)->not->toBeEmpty();
        expect($test_tag['is_sensitive'])->toBeTrue();

        $response = $this
            ->actingAs(create_test_user())
            ->get(getTagFilterUrl($test_tag->code));
        $response->assertOk();

        $data = getListPageData($response);
        expect($data)->not()->toBeEmpty();

        foreach ($data as $capture) {
            expect($capture)->toHaveKey('tags');
            expect($capture['tags'])->not()->toBeEmpty();

            $tag_codes = collect($capture['tags'])->pluck('code')->toArray();
            expect($tag_codes)->toContain($test_tag->code);
        }
    });
});
