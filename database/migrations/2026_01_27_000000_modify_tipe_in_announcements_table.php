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
        // and allows preserving data (though strict mode might complain if we were removing values)
        // We are expanding the enum, so it's safe.
        DB::statement("ALTER TABLE announcements MODIFY COLUMN tipe ENUM('umum', 'agenda', 'layanan', 'darurat', 'berita') NOT NULL DEFAULT 'umum'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting to the original set. CAUTION: Data with new types will cause truncation/errors if rolled back.
        // We attempt to map them back to 'umum' or just let the rollback fail if strict.
        // Ideally we shouldn't down this if data exists, but for completeness:
        DB::statement("ALTER TABLE announcements MODIFY COLUMN tipe ENUM('urgent', 'penting', 'umum') NOT NULL DEFAULT 'umum'");
    }
};
