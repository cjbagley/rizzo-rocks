<?php

use App\Models\Scopes\SensitiveTagScope;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('code', 3)->after('tag');
        });

        // Based on the data at time migration ran, below is sufficient and causes no
        // duplicates; not worth doing something more fancy as YAGNI
        foreach (Tag::withoutGlobalScope(SensitiveTagScope::class)->get() as $tag) {
            $tag->code = substr($tag->tag, 0, 1);
            $tag->save();
        }
    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
