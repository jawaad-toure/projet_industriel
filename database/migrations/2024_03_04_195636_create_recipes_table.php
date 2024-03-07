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
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipename', 50)->unique()->notNullable();
            $table->time('time')->notNullable();
            $table->enum('cookingtype', ['four', 'barbecue', 'poele', 'vapeur', 'sans cuisson']);
            $table->enum('category', ['entree', 'plat', 'dessert', 'boisson']);
            $table->enum('difficulty', ['difficile', 'facile', 'moyen']);
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
