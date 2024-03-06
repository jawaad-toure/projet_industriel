<?php

namespace App\Repositories;

use App\Models\Recipe;

final class RecipeRepository
{

    public function deleteRecipe(int $recipeId)
    {
        Recipe::where('id', $recipeId)
            ->delete();
    }
}