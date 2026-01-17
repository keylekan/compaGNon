<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('race_id')
                ->constrained('playable_races')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('gender', 1);      // H / F
            $table->string('alignment', 2);   // LB, NN, CM, etc.

            $table->timestamps();
            $table->softDeletes();

            // Accès rapide au "dernier personnage" d'un user
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
