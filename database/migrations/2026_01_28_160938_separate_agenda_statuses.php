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
        Schema::table('agenda', function (Blueprint $table) {
            $table->string('status_publikasi')->default('published')->after('is_featured');
            $table->string('status_kegiatan')->default('scheduled')->after('status_publikasi');
        });

        // Copy data from old status to status_publikasi
        \DB::statement('UPDATE agenda SET status_publikasi = status');

        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->string('status')->default('published');
        });

        \DB::statement('UPDATE agenda SET status = status_publikasi');

        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn(['status_publikasi', 'status_kegiatan']);
        });
    }
};
