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
        Schema::create('layanan_publik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('persyaratan')->nullable(); // Requirements - JSON or text
            $table->string('waktu_proses')->nullable(); // Processing time (e.g., "3 hari kerja")
            $table->decimal('biaya', 15, 2)->default(0); // Cost
            $table->string('penanggung_jawab')->nullable(); // Person in charge
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('icon')->nullable(); // Icon for UI
            $table->string('gambar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0); // Display order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_publik');
    }
};
