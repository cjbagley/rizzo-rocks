<?php

namespace App\Models;

use App\Models\Scopes\SensitiveTagScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property bool $is_sensitive
 * @property bool $is_selected
 */
#[ScopedBy([SensitiveTagScope::class])]
class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;

    protected $casts = [
        'is_sensitive' => 'boolean',
    ];

    protected $visible = [
        'tag',
        'code',
        'colour',
        'is_sensitive',
        'is_selected',
    ];

    protected $fillable = [
        'tag',
        'code',
        'colour',
        'is_sensitive',
    ];

    public function captures()
    {
        return $this->belongsToMany(GameCapture::class, 'game_capture_tag');
    }
}
