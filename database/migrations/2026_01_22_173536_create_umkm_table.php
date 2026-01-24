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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('slug')->unique();
            $table->string('nama_pemilik');
            $table->string('kategori'); // Food, Craft, Service, etc.
            $table->text('deskripsi')->nullable();
            $table->text('produk_layanan')->nullable(); // Products/services offered
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('foto_produk')->nullable();
            $table->integer('tahun_berdiri')->nullable();
            $table->decimal('kisaran_harga_min', 15, 2)->nullable();
            $table->decimal('kisaran_harga_max', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
