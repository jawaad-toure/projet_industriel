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
        Schema::create('stars_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('stars', [1, 2, 3, 4, 5])->notNullable();
            $table->text('comment')->nullable();
            
            $table->unsignedBigInteger('id_recipe');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_recipe')->references('id')->on('recipes');
            $table->foreign('id_user')->references('id')->on('users');
           
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stars_comments');
    }
};

