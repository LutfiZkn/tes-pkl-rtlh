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
        Schema::create('foto_rumah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rumah_id')
                ->constrained('rumah')
                ->cascadeOnDelete();

            $table->string('nama_file');
            $table->string('path');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_rumah');
    }
};
