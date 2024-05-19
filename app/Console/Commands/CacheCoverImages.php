<?php

namespace App\Console\Commands;

use App\Enums\Disk;
use App\Enums\ImageSize;
use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class CacheCoverImages extends Command
{
    public const IMG_SLUG = 'https://images.igdb.com/igdb/image/upload/t_%s/%s.jpg';

    protected $signature = 'app:cache-cover-images';

    protected $description = 'Cache game cover images from IGDB';

    public function handle()
    {
        $storage = Storage::disk(Disk::Covers->value);

        foreach (Game::all() as $game) {
            $igdb_url = sprintf(self::IMG_SLUG, ImageSize::Cover_big->value, $game->igdb_cover_id);
            $img = file_get_contents($igdb_url);
            $storage->put($game->getCoverImageFilename(), $img, 'public');

            $jpg = $storage->path($game->getCoverImageFilename());
            $webp = $storage->path($game->getCoverImageFilename('.webp'));

            Image::load($jpg)->save($webp);
            Image::load($webp)->optimize()->save($webp);
        }

        $this->info('All done!');
    }
}
