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
        Schema::create('profile_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('sejarah')->nullable();
            
            $table->decimal('luas_wilayah', 10, 2)->nullable();
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();
            
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('ketinggian')->nullable();
            
            $table->integer('jumlah_penduduk')->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->integer('jumlah_laki_laki')->nullable();
            $table->integer('jumlah_perempuan')->nullable();
            $table->integer('jumlah_dusun')->nullable();
            $table->integer('jumlah_rw')->nullable();
            $table->integer('jumlah_rt')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_desas');
    }
};
