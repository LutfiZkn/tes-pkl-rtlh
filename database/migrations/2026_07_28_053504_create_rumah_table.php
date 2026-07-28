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
        Schema::create('rumah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kelurahan_id')
            ->constrained('kelurahan')
            ->restrictOnDelete();

            $table->string('nama_pemilik', 100)->unique();
            $table->string('nik', 16)->unique();
            $table->text('alamat');
            $table->string('kondisi', 30);
            $table->integer('tahun_pendataan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah');
    }
};
