<?php

use App\Enums\GameCaptureType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_captures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('game_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', [GameCaptureType::Image->value, GameCaptureType::Video->value]);
            $table->string('href');
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_captures');
    }
};
