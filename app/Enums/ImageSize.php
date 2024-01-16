<?php

namespace App\Enums;

enum ImageSize: string
{
    case Thumb = 'thumb';
    case Seven_twenty_p = '720p';
    case Cover_small = 'cover_small';
    case Cover_big = 'cover_big';
}
