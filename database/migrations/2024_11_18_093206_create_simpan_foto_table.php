<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpanFotoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_posts', function (Blueprint $table) {
            $table->id('id_save'); // Primary key
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('id_post')->constrained('upload')->onDelete('cascade');
            $table->timestamps(); // Timestamps created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_posts');
    }
}
