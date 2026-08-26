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
        Schema::table('rumah', function (Blueprint $table) {
            $table->string('status_verifikasi')->default('Belum diverifikasi')->after('keterangan');
            $table->text('alasan_penolakan')->nullable()->after('status_verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rumah', function (Blueprint $table) {
            $table->dropColumn([
                'status_verifikasi',
                'alasan_penolakan',
            ]);
        });
    }
};
