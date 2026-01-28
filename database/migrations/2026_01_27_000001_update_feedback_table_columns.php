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
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('rt', 5)->nullable()->after('nama');
            $table->string('rw', 5)->nullable()->after('rt');
            $table->renameColumn('pesan', 'deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->renameColumn('deskripsi', 'pesan');
            $table->dropColumn(['rt', 'rw']);
        });
    }
};
