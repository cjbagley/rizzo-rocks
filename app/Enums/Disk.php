<?php

namespace App\Enums;

enum Disk: string
{
    case Image = 'images';
    case Video = 'videos';
    case Thumbs = 'thumbs';
    case Covers = 'covers';
}
