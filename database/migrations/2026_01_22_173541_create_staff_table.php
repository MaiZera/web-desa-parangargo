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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable(); // Nomor Induk Pegawai
            $table->string('jabatan'); // Position
            $table->string('pangkat')->nullable(); // Rank
            $table->string('golongan')->nullable(); // Grade
            $table->string('pendidikan')->nullable(); // Education
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('mulai_menjabat')->nullable(); // Start of service
            $table->date('selesai_menjabat')->nullable(); // End of service
            $table->integer('urutan')->default(0); // Display order for org structure
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
