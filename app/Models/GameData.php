<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class GameData
{
    private array $raw_data;
    private string $cover_url_slug;

    public int $id;
    public string $name;
    public array $platforms;
    public int $rating;
    public string $summary;
    public string $info_url;

    public function __construct(array $data)
    {
        $this->raw_data = $data;
        $this->id = Arr::get($data, 'id', '-');
        $this->name = Arr::get($data, 'name', '-');
        $this->cover_url_slug = $this->getCoverUrlSlug();
        $this->platforms = Arr::has($data, 'platforms') ? array_column($data['platforms'], 'abbreviation') : [];
        $this->rating = Arr::has($data, 'total_rating') ? round($data['total_rating']) : 0;
        $this->summary = Arr::get($data, 'summary', 'No summary avialable');
        $this->info_url = Arr::get($data, 'url', '');
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
        if (empty($this->cover_url_slug)) {
            return '';
        }
        return 'https:' . Str::replace('/{img_type}/', sprintf('/%s/', $type), $this->cover_url_slug);
    }
}
