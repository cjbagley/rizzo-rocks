<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GameLookupData
{
    private readonly string $cover_url_slug;

    public int $id;

    public string $name;

    public array $platforms;

    public int $rating;

    public string $summary;

    public string $info_url;

    public string $cover_image_id;

    public array $raw_data;

    public function __construct(array $raw_data)
    {
        $this->raw_data = $raw_data;
        $this->id = Arr::get($this->raw_data, 'id', '-');
        $this->name = Arr::get($this->raw_data, 'name', '-');
        $this->cover_url_slug = $this->getCoverUrlSlug();
        $this->platforms = Arr::has($this->raw_data, 'platforms') ? array_column($this->raw_data['platforms'], 'abbreviation') : [];
        $this->rating = Arr::has($this->raw_data, 'total_rating') ? round($this->raw_data['total_rating']) : 0;
        $this->summary = Arr::get($this->raw_data, 'summary', 'No summary avialable');
        $this->info_url = Arr::get($this->raw_data, 'url', '');
        $this->cover_image_id = Arr::get($this->raw_data, 'cover.image_id', '');
    }

    /*
    * URL given by API: //images.igdb.com/.../t_{size}/{game_hash}.jpg
    */
    private function getCoverUrlSlug(): string
    {
        if (empty($this->raw_data['cover']['url'])) {
            return '';
        }

        $url = $this->raw_data['cover']['url'];
        if (Str::startsWith($url, '////')) {
            return '';
        }

        return Str::replace('/t_thumb/', '/{img_type}/', $url);
    }

    public function getReleaseDate(): string
    {
        if (!empty($this->raw_data['first_release_date'])) {
            return Carbon::parse($this->raw_data['first_release_date'])->format('d/m/Y');
        }

        return '-';
    }

    public function getCoverImageUrl($type = 't_thumb'): string
    {
        if ($this->cover_url_slug === '' || $this->cover_url_slug === '0') {
            return '';
        }

        return 'https:' . Str::replace('/{img_type}/', sprintf('/%s/', $type), $this->cover_url_slug);
    }
}
