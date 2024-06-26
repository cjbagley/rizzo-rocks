<?php

namespace App\Models;

use App\Enums\Disk;
use App\Enums\GameCaptureType;
use App\Enums\ImageSize;
use App\Models\Scopes\SensitiveGameScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @property string $cover
 * @property string $url
 * @property string $tags
 */
class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timesptamps = true;

    protected $casts = [
        'is_sensitive' => 'boolean',
    ];

    protected $visible = [
        'title',
        'played_years',
        'comments',
        'cover',
        'url',
        'igdb_url',
        'capture_count',
    ];

    protected $fillable = [
        'title',
        'played_years',
        'comments',
        'igdb_id',
        'igdb_cover_id',
        'igdb_url',
        'is_sensitive',
    ];

    protected $appends = ['cover', 'url', 'capture_count'];

    protected function cover(): Attribute
    {
        return new Attribute(fn () => $this->getCoverImageUrl());
    }

    protected function url(): Attribute
    {
        return new Attribute(fn () => $this->getPageUrl());
    }

    protected function captureCount(): Attribute
    {
        return new Attribute(fn () => $this->captures->count());
    }

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

        static::addGlobalScope(SensitiveGameScope::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCoverImageUrl(ImageSize $size = ImageSize::Cover_small, bool $retina = true): string
    {
        $fn = $this->getCoverImageFilename('.webp');
        if (Storage::disk(Disk::Covers->value)->exists($fn)) {
            return Storage::disk(Disk::Covers->value)->url($fn);
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
