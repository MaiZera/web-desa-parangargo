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
        Schema::table('news', function (Blueprint $table) {
            // Drop the index first, if it exists. 
            // In SQLite, indexes on columns being dropped might cause issues if not explicitly handled or if there are constraints.
            // Explicitly dropping the named index is safer.
            $table->dropIndex('idx_news_category');
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->index('category', 'idx_news_category');
        });
    }
};
