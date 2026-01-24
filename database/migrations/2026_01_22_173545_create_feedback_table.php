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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('subjek');
            $table->text('pesan');
            $table->string('kategori')->nullable(); // Complaint, suggestion, question, praise
            $table->enum('status', ['baru', 'dibaca', 'diproses', 'selesai'])->default('baru');
            $table->text('tanggapan')->nullable(); // Response
            $table->foreignId('responder_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('responded_at')->nullable();
            $table->integer('rating')->nullable(); // 1-5 satisfaction rating
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
