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
        DB::statement("ALTER TABLE agenda MODIFY COLUMN status ENUM('draft', 'published', 'scheduled', 'ongoing', 'completed', 'cancelled') DEFAULT 'published'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE agenda MODIFY COLUMN status ENUM('scheduled', 'ongoing', 'completed', 'cancelled') DEFAULT 'scheduled'");
    }
};
