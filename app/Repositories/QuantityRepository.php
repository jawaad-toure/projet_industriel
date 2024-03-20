<?php

namespace App\Repositories;

use App\Models\Quantity;
use Illuminate\Support\Facades\DB;

final class QuantityRepository
{
    public function addQuantity(string $quantity, string $id_unit, string $id_ingredient, string $id_recipe)
    {
        Quantity::create([
            'quantity' => $quantity,
            'id_unit' => $id_unit,
            'id_ingredient' => $id_ingredient,
            'id_recipe' => $id_recipe,
        ]);
    }

    public function getQuantity(int $quantityId)
    {
        return Quantity::where('id', $quantityId)
            ->first();
    }

    public function updateQuantity(int $quantityId, int $recipeId, int $quantity)
    {
        Quantity::where('id', $quantityId)
            ->where('id_recipe', $recipeId)
            ->update(
                ['quantity' => $quantity]
            );
    }

    public function updateIdIngredient(int $quantityId, int $recipeId, int $idIngredient)
    {
        Quantity::where('id', $quantityId)
            ->where('id_recipe', $recipeId)
            ->update(
                ['id_ingredient' => $idIngredient]
            );
    }

    public function updateIdUnit(int $quantityId, int $recipeId, int $idUnit)
    {
        Quantity::where('id', $quantityId)
            ->where('id_recipe', $recipeId)
            ->update(
                ['id_unit' => $idUnit]
            );
    }

    public function getRecipeQuantities(int $recipeId)
    {
        return DB::table('quantities')
            ->join('ingredients', 'quantities.id_ingredient', '=', 'ingredients.id')
            ->join('units', 'quantities.id_unit', '=', 'units.id')
            ->where('quantities.id_recipe', $recipeId)
            ->get([
                'quantities.id as id',
                'quantities.quantity as quantity',
                'ingredients.ingredientname as ingredientname',
                'units.unitname as unitname',
            ]);
    }  

    public function isRecipeQuantitiesMoreThanZero(int $recipeId)
    {
        return Quantity::where('id_recipe', $recipeId)->get()->count() > 0;
    }

    public function deleteQuantity(int $quantityId, int $recipeId)
    {
        Quantity::where('id', $quantityId)
            ->where('id_recipe', $recipeId)
            ->delete();
    }

    public function deleteRecipeQunatities(int $recipeId)
    {
        Quantity::where('id_recipe', $recipeId)
            ->delete();
    }
}