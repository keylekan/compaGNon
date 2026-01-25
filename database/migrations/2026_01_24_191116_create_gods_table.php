<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('short_description', 255);
            $table->text('description')->nullable();
            $table->string('icon_path')->nullable();  // ex: images/gods/beory.png
            // null = tous alignements autorisés, sinon liste de codes: ["LB","LN","LM"] etc.
            $table->json('allowed_believer_alignments')->nullable();
            // null = tous alignements autorisés, sinon liste de codes: ["LB","LN","LM"] etc.
            $table->json('allowed_cleric_alignments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gods');
    }
};
