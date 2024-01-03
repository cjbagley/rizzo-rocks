<?php

namespace App\Models;

use Illuminate\Support\Str;

class GameData
{
    private $raw_data;
    private $cover_url_slug = '';

    public $id = '';
    public $name = '';

    public function __construct(array $data)
    {
        $this->raw_data = $data;
        $this->id = !empty($data['id']) ? $data['id'] : '';
        $this->name = !empty($data['name']) ? $data['name'] : '';
        $this->cover_url_slug = $this->getCoverUrlSlug();
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

    public function getCoverImageUrl($type = 't_thumb'): string
    {
        if (empty($this->cover_url_slug)) {
            return '';
        }
        return 'https:' . Str::replace('/{img_type}/', sprintf('/%s/', $type), $this->cover_url_slug);
    }
}
