<?php

use App\Models\GameCapture;
use App\Models\Scopes\SensitiveGameCaptureScope;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('game_captures', function (Blueprint $table) {
            $table->string('filekey')->nullable()->after('href');
        });

        foreach (GameCapture::withoutGlobalScope(SensitiveGameCaptureScope::class)->get() as $capture) {
            $href = basename($capture->getRawOriginal('href'));
            $capture->filekey = pathinfo($href, PATHINFO_FILENAME);
            $capture->save();
        }

        Schema::table('game_captures', function (Blueprint $table) {
            $table->string('filekey')->nullable(false)->change();
            $table->index('filekey');
        });
    }

    public function down(): void
    {
        Schema::table('game_captures', function (Blueprint $table) {
            $table->dropIndex(['filekey']);
            $table->dropColumn('filekey');
        });
    }
};
