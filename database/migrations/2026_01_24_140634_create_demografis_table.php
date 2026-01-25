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
        Schema::create('demografis', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('kepadatan')->nullable();
            $table->text('struktur_umur')->nullable();
            $table->text('jenis_kelamin')->nullable();
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
