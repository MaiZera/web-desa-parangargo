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
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            // Visi & Misi
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->longText('sejarah')->nullable();
            
            // Data Geografis
            $table->decimal('luas_wilayah', 10, 2)->nullable(); // dalam km²
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('ketinggian')->nullable(); // mdpl (meter di atas permukaan laut)
            
            // Data Demografis
            $table->integer('jumlah_penduduk')->default(0);
            $table->integer('jumlah_kk')->default(0); // kepala keluarga
            $table->integer('jumlah_laki_laki')->default(0);
            $table->integer('jumlah_perempuan')->default(0);
            $table->integer('jumlah_dusun')->default(0);
            $table->integer('jumlah_rw')->default(0);
            $table->integer('jumlah_rt')->default(0);
            
            // Media & Gambar
            $table->string('logo')->nullable();
            $table->string('gambar_kantor')->nullable();
            $table->string('gambar_peta')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
