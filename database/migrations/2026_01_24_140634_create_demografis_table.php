<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demografis', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('kepadatan_penduduk')->nullable();
            $table->text('struktur_umur')->nullable();
            $table->integer('jumlah_kk')->default(0); // kepala keluarga
            $table->integer('jumlah_laki_laki')->default(0);
            $table->integer('jumlah_perempuan')->default(0);
            $table->integer('jumlah_dusun')->default(0);
            $table->integer('jumlah_rw')->default(0);
            $table->integer('jumlah_rt')->default(0);
            $table->text('tingkat_pendidikan')->nullable();
            $table->text('mata_pencaharian')->nullable();
            $table->text('agama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografis');
    }
};
