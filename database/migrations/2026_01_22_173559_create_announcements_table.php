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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            $table->enum('tipe', ['urgent', 'penting', 'umum'])->default('umum'); // Type/Priority
            $table->date('tanggal_mulai')->nullable(); // Start display date
            $table->date('tanggal_selesai')->nullable(); // End display date
            $table->string('icon')->nullable();
            $table->string('file_lampiran')->nullable(); // Attachment file
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
