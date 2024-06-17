<?php

use App\Models\Game;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    const SENSITIVE_GAMES = [
        3199,
        19521,
        3042,
        9630,
        103020,
        16,
        16605,
        6045,
        20065,
        6707,
        20871,
    ];

    public function up(): void
    {
        Game::whereIn('igdb_id', self::SENSITIVE_GAMES)->update(['is_sensitive' => true]);
    }

    public function down(): void
    {
        Game::whereNull('deleted_at')->update(['is_sensitive' => false]);
    }
};
