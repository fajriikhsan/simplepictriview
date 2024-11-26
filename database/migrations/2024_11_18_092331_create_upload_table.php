<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id('id_post'); // Primary key
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->string('file_post'); // Path file upload
            $table->string('judul_post'); // Judul postingan
            $table->text('desk_post')->nullable(); // Deskripsi postingan
            $table->timestamp('tgl_post'); // Tanggal posting
            $table->timestamps(); // Timestamps created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
