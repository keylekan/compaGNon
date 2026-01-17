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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')->constrained()->cascadeOnDelete();

            $table->string('email');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // si tes characters appartiennent à un user, nullOnDelete est ok
            $table->foreignId('character_id')->nullable()->constrained()->nullOnDelete();

            $table->string('invite_status')->default('invited');
            $table->string('payment_status')->default('unknown');

            $table->dateTime('invited_at')->nullable();
            $table->dateTime('linked_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('paid_at')->nullable();

            $table->timestamps();

            $table->unique(['event_id', 'email']);
            $table->index(['event_id', 'user_id']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
