<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skill_playable_race', function (Blueprint $table) {
            $table->id();

            $table->foreignId('skill_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('playable_race_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['skill_id', 'playable_race_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_playable_race');
    }
};
