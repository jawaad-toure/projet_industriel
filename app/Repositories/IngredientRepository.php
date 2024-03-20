<?php

namespace App\Repositories;

use App\Models\Ingredient;

final class IngredientRepository
{
    public function addIngredient(string $ingredientname)
    {
        Ingredient::create([
            'ingredientname' => $ingredientname,
            'calorie' => 0.00
        ]);
    }

    public function getIngredient(int $ingredientId)
    {
        return Ingredient::where('id', $ingredientId)
            ->first();
    }

    public function getIngredientId(string $ingredientname): int
    {
        $ingredient = Ingredient::where('ingredientname', $ingredientname)
            ->first();

        return $ingredient->id;
    }

    public function doesIngredientExist(string|int $ingredientNameOrId)
    {
        return Ingredient::where('id', $ingredientNameOrId)
            ->orWhere('ingredientname', $ingredientNameOrId)
            ->exists();
    }

    public function getIngredients()
    {
        return Ingredient::all();
    }
}
