<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ImageSize;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GameCapture;
use Illuminate\Database\Eloquent\Builder;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        $slug = "https://images.igdb.com/igdb/image/upload/t_%s/%s.jpg";
        if ($retina) {
            return sprintf($slug, $size->value . "_2x", $this->igdb_cover_id);
        }
        return sprintf($slug, $size->value, $this->igdb_cover_id);
    }

    public function getPageUrl(): string
    {
        return route('game.view', $this);
    }
}
