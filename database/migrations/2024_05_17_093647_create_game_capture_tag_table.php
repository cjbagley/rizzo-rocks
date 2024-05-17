<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_capture_tag', function (Blueprint $table) {
            $table->foreignId('game_capture_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_capture_tag');
    }
};
