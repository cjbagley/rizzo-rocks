<?php

namespace App\Models;

use App\Enums\Disk;
use App\Enums\GameCaptureType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $thumb
 * @property string $url
 */
class GameCapture extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timesptamps = true;

    protected $visible = [
        'title',
        'url',
        'thumb',
        'comments',
    ];

    protected $fillable = [
        'title',
        'game_id',
        'type',
        'filekey',
        'comments',
    ];

    protected $appends = ['thumb', 'url'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'game_capture_tag');
    }

    protected function url(): Attribute
    {
        return Attribute::make(get: function (mixed $value, array $attrs) {
            $value = $attrs['filekey'];

            return match ($attrs['type']) {
                GameCaptureType::Image->value => Storage::disk(Disk::Image->value)->url($value.'.webp'),
                GameCaptureType::Video->value => Storage::disk(Disk::Video->value)->url($value.'.webm'),
                default => '#',
            };
        });
    }

    protected function thumb(): Attribute
    {
        return Attribute::make(get: function (mixed $value, array $attrs) {
            $file = $attrs['filekey'].'.webp';
            if (! Storage::disk(Disk::Thumbs->value)->exists($file)) {
                return $this->url;
            }

            return Storage::disk(Disk::Thumbs->value)->url($file);
        });
    }
}
