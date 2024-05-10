<?php

namespace App\Models;

use App\Enums\GameCaptureType;
use App\Enums\ImageSize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    const COVER_IMG_CACHE_DIR = 'covers';

    public $timesptamps = true;

    protected $fillable = [
        'title',
        'played_years',
        'comments',
        'igdb_id',
        'igdb_cover_id',
        'igdb_url',
    ];

    public function captures(): HasMany
    {
        return $this->hasMany(GameCapture::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(GameCapture::class)->where('game_captures.type', '=', GameCaptureType::Video);
    }

    public function images(): HasMany
    {
        return $this->hasMany(GameCapture::class)->where('game_captures.type', '=', GameCaptureType::Image);
    }

    protected static function booted(): void
    {
        static::saving(function (Game $game) {
            $game->slug = Str::slug($game->title);
        });

        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('title');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function addCalculatedFields()
    {
        $this->cover = $this->getCoverImageUrl();
        $this->page_url = $this->getPageUrl();
    }

    public function getCoverImageUrl(ImageSize $size = ImageSize::Cover_small, bool $retina = true): string
    {
        $fn = $this->getCoverImageFilename('.webp');
        if (Storage::disk(self::COVER_IMG_CACHE_DIR)->exists($fn)) {
            return Storage::disk(self::COVER_IMG_CACHE_DIR)->url($fn);
        }

        $slug = 'https://images.igdb.com/igdb/image/upload/t_%s/%s.jpg';
        if ($retina) {
            return sprintf($slug, $size->value.'_2x', $this->igdb_cover_id);
        }

        return sprintf($slug, $size->value, $this->igdb_cover_id);
    }

    public function getCoverImageFilename(string $ext = '.jpg'): string
    {
        return $this->igdb_cover_id.$ext;
    }

    public function getPageUrl(): string
    {
        return route('game.view', $this);
    }
}
