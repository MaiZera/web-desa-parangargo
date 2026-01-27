<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Using raw SQL to modify the ENUM column as it's the most reliable way without doctrine/dbal
        // and allows preserving data.

        // SQLite doesn't support MODIFY COLUMN. We skip this for SQLite assuming it treats ENUMs as TEXT 
        // or effectively doesn't enforce the modification limit without a table rebuild.
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE announcements MODIFY COLUMN tipe ENUM('umum', 'agenda', 'layanan', 'darurat', 'berita') NOT NULL DEFAULT 'umum'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE announcements MODIFY COLUMN tipe ENUM('urgent', 'penting', 'umum') NOT NULL DEFAULT 'umum'");
        }
    }
};
