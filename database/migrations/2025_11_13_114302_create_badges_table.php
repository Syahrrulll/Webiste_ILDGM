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
        // Mendefinisikan semua badge yang MUNGKIN ada di game
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('icon_svg'); // Untuk menyimpan kode SVG ikon
            $table->string('icon_color'); // Misal: 'text-yellow-500'
            $table->string('criteria_code')->unique(); // Kode unik untuk dicek, misal: 'HOAX_5'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
