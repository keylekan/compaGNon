<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->foreignId('team_id')
                ->nullable()
                ->constrained('teams')
                ->nullOnDelete()
                ->after('id'); // adapte si besoin
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropConstrainedForeignId('team_id');
        });
    }
};
