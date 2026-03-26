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
        Schema::table('playable_races', function (Blueprint $table) {
            $table->integer('hp_modifier')->default(0)->after('image_path');
            $table->unsignedSmallInteger('points_c')->default(0);
            $table->unsignedSmallInteger('points_l')->default(0);
            $table->unsignedSmallInteger('points_v')->default(0);
            $table->unsignedSmallInteger('points_r')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('playable_races', function (Blueprint $table) {
            $table->dropColumn(['hp_modifier','points_c','points_l','points_v','points_r']);
        });
    }
};
