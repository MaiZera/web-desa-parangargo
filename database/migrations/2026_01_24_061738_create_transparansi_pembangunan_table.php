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
        Schema::create('transparansi_pembangunan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pembangunan');
            $table->string('rt_number', 10); // RT 01, RT 02, etc
            $table->string('rw_number', 10)->nullable(); // RW 01, RW 02, etc
            $table->string('lokasi');
            $table->string('jenis_pembangunan'); // infrastruktur, fasilitas umum, dll
            $table->decimal('anggaran', 15, 2); // Budget pembangunan
            $table->string('sumber_dana'); // APBD, APBN, Swadaya, dll
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai_rencana');
            $table->date('tanggal_selesai_aktual')->nullable();
            $table->enum('status', ['perencanaan', 'dalam_proses', 'selesai', 'ditunda'])->default('perencanaan');
            $table->integer('persentase_penyelesaian')->default(0); // 0-100
            $table->text('keterangan')->nullable();
            $table->string('dokumentasi')->nullable(); // Path untuk foto
            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('rt_number');
            $table->index('status');
            $table->index('tanggal_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparansi_pembangunan');
    }
};
