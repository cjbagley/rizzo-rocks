<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $visible = [
        'tag',
        'colour',
        'is_sensitive',
    ];

    protected $fillable = [
        'tag',
        'colour',
        'is_sensitive',
    ];

    public function captures()
    {
        return $this->belongsToMany(GameCapture::class, 'game_capture_tag');
    }
}
