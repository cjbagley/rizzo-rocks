<?php

namespace App\Models;

use App\Enums\GameCaptureType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GameCapture extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timesptamps = true;

    protected $visible = [
        'title',
        'filekey',
        'url',
        'comments',
    ];

    protected $fillable = [
        'title',
        'game_id',
        'type',
        'filekey',
        'comments',
    ];

    protected $appends = ['url'];

    protected function url(): Attribute
    {
        return Attribute::make(get: function (mixed $value, array $attrs) {
            $value = $attrs['filekey'];

            return match ($attrs['type']) {
                GameCaptureType::Image->value => Storage::disk('images')->url($value.'.webp'),
                GameCaptureType::Video->value => Storage::disk('videos')->url($value.'.webm'),
                default => '#',
            };
        });
    }
}
