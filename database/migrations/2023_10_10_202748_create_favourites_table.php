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
        Schema::create('favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_id');
            $table->integer('song_id');
            $table->string('user_id');
            $table->string('favourite_list_id');
            $table->timestamp('date')->useCurerent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};
