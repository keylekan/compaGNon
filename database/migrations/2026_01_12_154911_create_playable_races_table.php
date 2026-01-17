<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playable_races', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();        // utile pour seed + URLs futures
            $table->string('title');                 // "Nain", "Elfe", ...
            $table->text('description')->nullable(); // lore + règles textuelles
            $table->string('image_path')->nullable();// ex: images/races/nain.webp
            $table->timestamps();

            $table->index('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
