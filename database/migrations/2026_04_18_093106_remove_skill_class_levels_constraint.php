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
        Schema::disableForeignKeyConstraints();
        Schema::table('skill_class_levels', function (Blueprint $table) {
            $table->dropUnique(['skill_id', 'playable_class_id']);
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_class_levels', function (Blueprint $table) {
            $table->unique(['skill_id', 'playable_class_id']);
        });
    }
};
