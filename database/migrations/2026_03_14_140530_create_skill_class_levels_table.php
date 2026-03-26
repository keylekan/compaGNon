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
        Schema::create('skill_class_levels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('skill_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('playable_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('level');

            $table->timestamps();

            // Un don ne peut être lié qu'à un seul niveau par classe donnée
            $table->unique(['skill_id', 'playable_class_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_class_levels');
    }
};
