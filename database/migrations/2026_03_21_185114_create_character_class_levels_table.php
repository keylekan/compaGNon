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
        Schema::create('character_class_levels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('level');
            $table->string('variant')->default('default');

            $table->timestamps();

            $table->unique(['character_class_id', 'level']);
            $table->index(['character_class_id', 'variant']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_class_levels');
    }
};
