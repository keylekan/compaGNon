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
        Schema::create('class_level_bonuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('playable_class_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('variant')->default('default');
            $table->unsignedSmallInteger('level');

            $table->unsignedSmallInteger('hit_points')->default(0);
            $table->unsignedSmallInteger('points_c')->default(0);
            $table->unsignedSmallInteger('points_l')->default(0);
            $table->unsignedSmallInteger('points_v')->default(0);
            $table->unsignedSmallInteger('points_r')->default(0);

            $table->timestamps();

            $table->unique(['playable_class_id', 'level', 'variant']);
            $table->index(['playable_class_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_level_bonuses');
    }
};
