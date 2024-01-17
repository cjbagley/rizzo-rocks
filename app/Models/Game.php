<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ImageSize;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    public $timesptamps = true;

    protected $fillable = [
        'title',
        'played_years',
        'comments',
        'igdb_id',
        'igdb_cover_id',
        'igdb_url',
    ];

    public function addCalculatedFields()
    {
        $this->cover = $this->getCoverImageUrl();
        $this->page_url = $this->getPageUrl();
    }

    public function getCoverImageUrl(ImageSize $size = ImageSize::Cover_big): string
    {
        $slug = "https://images.igdb.com/igdb/image/upload/t_%s/%s.jpg";
        return sprintf($slug, $size->value, $this->igdb_cover_id);
    }

    public function getPageUrl(): string
    {
        return route('game.view', $this);
    }
}
