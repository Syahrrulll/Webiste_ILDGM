<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->uuid('game_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('game_type', ['library', 'grammar', 'hoax', 'reading'])->default('library');
            $table->longText('game_data'); // JSON data
            $table->enum('status', ['in_progress', 'completed', 'failed'])->default('in_progress');
            $table->integer('score')->nullable();
            $table->integer('total_questions')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'game_type']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
