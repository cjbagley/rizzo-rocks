<?php

use App\Models\Game;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('igdb_url');
        });

        foreach (Game::withoutGlobalScopes()->get() as $game) {
            $game->slug = Str::slug($game->title);
            $game->save();
        }

        Schema::table('games', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropColumn('slug');
        });
    }
};
