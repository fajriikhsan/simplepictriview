<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profile_pictures', function (Blueprint $table) {
            $table->id('id_profile');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Menautkan ke tabel users
            $table->string('profile_picture'); // Path gambar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_pictures');
    }
};
