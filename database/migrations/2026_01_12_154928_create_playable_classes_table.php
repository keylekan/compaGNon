<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('playable_classes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();

            // Combattants / Lettrés / Roublards (affichage et tri UX)
            $table->string('category')->index();

            // null = tous alignements autorisés, sinon liste de codes: ["LB","LN","LM"] etc.
            $table->json('allowed_alignments')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playable_classes');
    }
};
