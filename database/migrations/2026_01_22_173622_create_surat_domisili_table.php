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
        Schema::create('surat_domisili', function (Blueprint $table) {
            $table->id();
            // Applicant Information
            $table->string('nama_pemohon');
            $table->string('nik', 16); // NIK (16 digits)
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('pekerjaan');
            $table->string('agama');
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('telepon');
            $table->string('email')->nullable();
            
            // Document Information
            $table->text('keperluan'); // Purpose of letter
            $table->string('nomor_surat')->nullable()->unique(); // Letter number
            $table->date('tanggal_surat')->nullable(); // Issue date
            
            // Status & Processing
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->text('catatan')->nullable(); // Admin notes
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('processed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_domisili');
    }
};
