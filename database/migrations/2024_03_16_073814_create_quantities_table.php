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
        Schema::create('quantities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('quantity')->notNullable();
            $table->unsignedBigInteger('id_unit');
            $table->unsignedBigInteger('id_ingredient');
            $table->unsignedBigInteger('id_recipe');
            
            $table->foreign('id_unit')->references('id')->on('units');
            $table->foreign('id_ingredient')->references('id')->on('ingredients');
            $table->foreign('id_recipe')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quantities');
    }
};