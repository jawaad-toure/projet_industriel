<?php

namespace App\Repositories;

use App\Models\Recipe;

final class RecipeRepository
{
    public function addRecipe(string $recipename, string $time, string $cookingtype, string $category, string $difficulty, int $for, int $unitId, int $userId)
    {
        Recipe::create([
            "recipename" => $recipename,
            "time" => $time,
            "cookingtype" => $cookingtype,
            "category" => $category,
            "difficulty" => $difficulty,
            "visibility" => false,
            "completed" => false,
            "for" => $for,
            "id_unit" => $unitId,
            "id_user" => $userId,
        ]);
    }

    public function getRecipe(int $recipeId): Recipe
    {
        return Recipe::where('id', $recipeId)
            ->first();
    }

    public function getRecipeId(string $recipename): int
    {
        $recipe = Recipe::where('recipename', $recipename)
            ->first();

        return $recipe->id;
    }

    public function getUserRecipes(int $userId)
    {
        return Recipe::where('id_user', $userId)
            ->get();
    }

    public function updateField(int $recipeId, string $field, string|int|bool $value)
    {
        Recipe::where('id', $recipeId)
            ->update([$field => $value]);
    }

    public function deleteRecipe(int $recipeId)
    {
        Recipe::where('id', $recipeId)
            ->delete();
    }
}
