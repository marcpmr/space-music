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
        Schema::create('songsdatabases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('song_id');
            $table->string('song_title');
            $table->string('song_artist');
            $table->string('song_image_url');
            $table->timestamp('date')->useCurerent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songsdatabases');
    }
};
