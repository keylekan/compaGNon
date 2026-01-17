<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('character_classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('playable_classes')
                ->restrictOnDelete();

            $table->unsignedSmallInteger('level')->default(1);

            $table->timestamps();

            // Un personnage ne peut avoir qu'une entrée par classe
            $table->unique(['character_id', 'class_id']);
            $table->index(['character_id', 'class_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_classes');
    }
};
