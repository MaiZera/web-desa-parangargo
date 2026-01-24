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
        Schema::create('surat_keterangan_usaha', function (Blueprint $table) {
            $table->id();
            // Applicant Information
            $table->string('nama_pemohon');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('pekerjaan');
            $table->text('alamat_pemohon');
            $table->string('telepon');
            $table->string('email')->nullable();
            
            // Business Information
            $table->string('nama_usaha');
            $table->string('jenis_usaha'); // Type of business
            $table->text('alamat_usaha');
            $table->string('bidang_usaha'); // Business field
            $table->integer('tahun_mulai_usaha')->nullable(); // Year started
            $table->decimal('modal_usaha', 15, 2)->nullable(); // Business capital
            $table->integer('jumlah_karyawan')->default(0);
            
            // Document Information
            $table->text('keperluan'); // Purpose
            $table->string('nomor_surat')->nullable()->unique();
            $table->date('tanggal_surat')->nullable();
            
            // Status & Processing
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('surat_keterangan_usaha');
    }
};
