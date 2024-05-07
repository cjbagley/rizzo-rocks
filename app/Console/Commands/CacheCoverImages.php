<?php

namespace App\Console\Commands;

use App\Enums\ImageSize;
use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CacheCoverImages extends Command
{
    const IMG_SLUG = 'https://images.igdb.com/igdb/image/upload/t_%s/%s.jpg';

    protected $signature = 'app:cache-cover-images';

    protected $description = 'Cache game cover images from IGDB';

    public function handle()
    {
        foreach (Game::all() as $game) {
            $img_url = sprintf(self::IMG_SLUG, ImageSize::Cover_small->value, $game->igdb_cover_id);
            $img = file_get_contents($img_url);
            Storage::disk(Game::COVER_IMG_CACHE_DIR)->put($game->getCoverImageFilename(), $img, 'public');
        }

        $this->info('All done!');
    }
}
