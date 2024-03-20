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
            $table->string('recipename', 255)->unique()->notNullable();
            $table->time('time')->notNullable();
            $table->enum('cookingtype', ['Four', 'Barbecue', 'Poele', 'Vapeur', 'Sans cuisson']);
            $table->enum('category', ['Entrée', 'Plat', 'Dessert', 'Boisson']);
            $table->enum('difficulty', ['Difficile', 'Facile', 'Moyen']);
            $table->enum('visibility', ['Private', 'Public']);
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
