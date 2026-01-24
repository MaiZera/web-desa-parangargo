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
        // News table indexes
        Schema::table('news', function (Blueprint $table) {
            $table->index('status', 'idx_news_status');
            $table->index('is_featured', 'idx_news_is_featured');
            $table->index('category', 'idx_news_category');
            $table->index('published_at', 'idx_news_published_at');
            $table->index(['status', 'is_featured'], 'idx_news_status_featured');
        });

        // Announcements table indexes
        Schema::table('announcements', function (Blueprint $table) {
            $table->index('status', 'idx_announcements_status');
            $table->index('tipe', 'idx_announcements_tipe');
            $table->index(['tanggal_mulai', 'tanggal_selesai'], 'idx_announcements_tanggal');
        });

        // Agenda table indexes
        Schema::table('agenda', function (Blueprint $table) {
            $table->index('status', 'idx_agenda_status');
            $table->index('is_featured', 'idx_agenda_is_featured');
            $table->index(['tanggal_mulai', 'tanggal_selesai'], 'idx_agenda_tanggal');
        });

        // Galeri table indexes
        Schema::table('galeri', function (Blueprint $table) {
            $table->index('kategori', 'idx_galeri_kategori');
            $table->index('is_featured', 'idx_galeri_is_featured');
            $table->index('tanggal_foto', 'idx_galeri_tanggal_foto');
        });

        // UMKM table indexes
        Schema::table('umkm', function (Blueprint $table) {
            $table->index('kategori', 'idx_umkm_kategori');
            $table->index('is_active', 'idx_umkm_is_active');
            $table->index(['kategori', 'is_active'], 'idx_umkm_kategori_active');
        });

        // Feedback table indexes
        Schema::table('feedback', function (Blueprint $table) {
            $table->index('status', 'idx_feedback_status');
            $table->index('kategori', 'idx_feedback_kategori');
            $table->index('rating', 'idx_feedback_rating');
        });

        // Surat Domisili table indexes
        Schema::table('surat_domisili', function (Blueprint $table) {
            $table->index('status', 'idx_surat_domisili_status');
            $table->index('nik', 'idx_surat_domisili_nik');
            $table->index('tanggal_surat', 'idx_surat_domisili_tanggal');
        });

        // Surat Keterangan Usaha table indexes
        Schema::table('surat_keterangan_usaha', function (Blueprint $table) {
            $table->index('status', 'idx_surat_usaha_status');
            $table->index('nik', 'idx_surat_usaha_nik');
            $table->index('tanggal_surat', 'idx_surat_usaha_tanggal');
        });

        // Staff table indexes
        Schema::table('staff', function (Blueprint $table) {
            $table->index('is_active', 'idx_staff_is_active');
            $table->index('urutan', 'idx_staff_urutan');
            $table->index(['is_active', 'urutan'], 'idx_staff_active_urutan');
        });

        // Layanan Publik table indexes
        Schema::table('layanan_publik', function (Blueprint $table) {
            $table->index('is_active', 'idx_layanan_is_active');
            $table->index('urutan', 'idx_layanan_urutan');
        });

        // Sponsors table indexes
        Schema::table('sponsors', function (Blueprint $table) {
            $table->index('is_active', 'idx_sponsors_is_active');
            $table->index('kategori', 'idx_sponsors_kategori');
            $table->index('urutan', 'idx_sponsors_urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // News table
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('idx_news_status');
            $table->dropIndex('idx_news_is_featured');
            $table->dropIndex('idx_news_category');
            $table->dropIndex('idx_news_published_at');
            $table->dropIndex('idx_news_status_featured');
        });

        // Announcements table
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropIndex('idx_announcements_status');
            $table->dropIndex('idx_announcements_tipe');
            $table->dropIndex('idx_announcements_tanggal');
        });

        // Agenda table
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropIndex('idx_agenda_status');
            $table->dropIndex('idx_agenda_is_featured');
            $table->dropIndex('idx_agenda_tanggal');
        });

        // Galeri table
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropIndex('idx_galeri_kategori');
            $table->dropIndex('idx_galeri_is_featured');
            $table->dropIndex('idx_galeri_tanggal_foto');
        });

        // UMKM table
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropIndex('idx_umkm_kategori');
            $table->dropIndex('idx_umkm_is_active');
            $table->dropIndex('idx_umkm_kategori_active');
        });

        // Feedback table
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropIndex('idx_feedback_status');
            $table->dropIndex('idx_feedback_kategori');
            $table->dropIndex('idx_feedback_rating');
        });

        // Surat Domisili table
        Schema::table('surat_domisili', function (Blueprint $table) {
            $table->dropIndex('idx_surat_domisili_status');
            $table->dropIndex('idx_surat_domisili_nik');
            $table->dropIndex('idx_surat_domisili_tanggal');
        });

        // Surat Keterangan Usaha table
        Schema::table('surat_keterangan_usaha', function (Blueprint $table) {
            $table->dropIndex('idx_surat_usaha_status');
            $table->dropIndex('idx_surat_usaha_nik');
            $table->dropIndex('idx_surat_usaha_tanggal');
        });

        // Staff table
        Schema::table('staff', function (Blueprint $table) {
            $table->dropIndex('idx_staff_is_active');
            $table->dropIndex('idx_staff_urutan');
            $table->dropIndex('idx_staff_active_urutan');
        });

        // Layanan Publik table
        Schema::table('layanan_publik', function (Blueprint $table) {
            $table->dropIndex('idx_layanan_is_active');
            $table->dropIndex('idx_layanan_urutan');
        });

        // Sponsors table
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropIndex('idx_sponsors_is_active');
            $table->dropIndex('idx_sponsors_kategori');
            $table->dropIndex('idx_sponsors_urutan');
        });
    }
};
