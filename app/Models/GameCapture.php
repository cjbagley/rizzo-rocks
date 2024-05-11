<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameCapture extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timesptamps = true;

    protected $visible = [
        'title',
        'href',
        'comments',
    ];

    protected $fillable = [
        'title',
        'game_id',
        'type',
        'href',
        'comments',
    ];
}
