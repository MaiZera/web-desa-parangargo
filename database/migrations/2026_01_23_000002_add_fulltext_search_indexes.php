<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        // Add fulltext index to news table for search functionality
        DB::statement('ALTER TABLE news ADD FULLTEXT idx_news_search (title, summary, content)');

        // Add fulltext index to umkm table for business search
        DB::statement('ALTER TABLE umkm ADD FULLTEXT idx_umkm_search (nama_usaha, deskripsi, produk_layanan)');

        // Add fulltext index to layanan_publik table for service search
        DB::statement('ALTER TABLE layanan_publik ADD FULLTEXT idx_layanan_search (nama_layanan, deskripsi)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        // Drop fulltext indexes
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('idx_news_search');
        });

        Schema::table('umkm', function (Blueprint $table) {
            $table->dropIndex('idx_umkm_search');
        });

        Schema::table('layanan_publik', function (Blueprint $table) {
            $table->dropIndex('idx_layanan_search');
        });
    }
};
