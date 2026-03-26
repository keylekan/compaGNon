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
        Schema::create('character_skill', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('skill_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('cost_paid_c')->nullable()->default(null);
            $table->unsignedSmallInteger('cost_paid_l')->nullable()->default(null);
            $table->unsignedSmallInteger('cost_paid_v')->nullable()->default(null);
            $table->unsignedSmallInteger('cost_paid_r')->nullable()->default(null);

            $table->timestamp('purchased_at')->nullable();

            $table->timestamps();

            $table->index(['character_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_skill');
    }
};
