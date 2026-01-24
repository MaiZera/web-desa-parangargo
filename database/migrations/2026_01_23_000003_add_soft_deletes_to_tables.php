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
        // Add soft deletes to news table
        Schema::table('news', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to announcements table
        Schema::table('announcements', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to umkm table
        Schema::table('umkm', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to agenda table
        Schema::table('agenda', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to galeri table
        Schema::table('galeri', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove soft deletes from news table
        Schema::table('news', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from announcements table
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from umkm table
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from agenda table
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove soft deletes from galeri table
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
