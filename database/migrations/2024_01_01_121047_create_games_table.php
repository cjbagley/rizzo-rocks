<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('played_years')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('igdb_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('title');
            $table->index('igdb_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
