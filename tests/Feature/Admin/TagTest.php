<?php

use App\Models\Tag;

const ADMIN_TAG_URL = '/admin/tags';

test('tag index page is displayed', function () {
    $this
        ->actingAs(create_test_user())
        ->get(ADMIN_TAG_URL)
        ->assertOk();
});

test('tag can be added', function () {
    /** @var Tag $tag */
    $tag = create_test_tag();

    $this
        ->actingAs(create_test_user())
        ->post(ADMIN_TAG_URL, [
            'colour' => $tag->colour,
            'is_sensitive' => $tag->is_sensitive,
            'tag' => $tag->tag,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_TAG_URL);

    $saved_tag = Tag::where(['tag' => $tag->tag])->first();
    expect($saved_tag->tag)->toBe($tag->tag);
    expect($saved_tag->colour)->toBe($tag->colour);
    expect($saved_tag->is_sensitive)->toBe($tag->is_sensitive);
});

test('tag can be edited', function () {
    /** @var Tag $tag */
    $tag = create_test_tag();
    $original_tag = clone $tag;
    $updated_tag = clone $tag;
    $updated_tag->tag = fake()->word();

    $this
        ->actingAs(create_test_user())
        ->put(sprintf('%s/%s', ADMIN_TAG_URL, $original_tag->tag), [
            'colour' => $original_tag->colour,
            'is_sensitive' => $original_tag->is_sensitive,
            'tag' => $original_tag->tag,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_TAG_URL);

    // Note - need to refresh here to get updated slug
    $updated_tag->refresh();

    expect($original_tag->tag)->not->toBe($updated_tag->tag);

    expect($updated_tag->colour)->toBe($original_tag->colour);
    expect($updated_tag->is_sensitive)->toBe($original_tag->is_sensitive);
});

test('tag can be deleted', function () {
    $tag = create_test_tag();

    $this
        ->actingAs(create_test_user())
        ->delete(route('tags.destroy', $tag))
        ->assertSessionHasNoErrors()
        ->assertRedirect(ADMIN_TAG_URL);

    expect(Tag::find($tag->id))->toBeNull();
});
