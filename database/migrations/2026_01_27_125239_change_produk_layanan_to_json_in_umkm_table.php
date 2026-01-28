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
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn('produk_layanan');
        });
        Schema::table('umkm', function (Blueprint $table) {
            $table->json('produk_layanan')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn('produk_layanan');
        });
        Schema::table('umkm', function (Blueprint $table) {
            $table->text('produk_layanan')->nullable()->after('deskripsi');
        });
    }
};
