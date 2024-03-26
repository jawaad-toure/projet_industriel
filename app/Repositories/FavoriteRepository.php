<?php

namespace App\Repositories;

use App\Models\Favorite;

class FavoriteRepository
{
    public function addFavorite(int $userId, int $recipeId)
    {
        Favorite::create([
            'id_user' => $userId,
            'id_recipe' => $recipeId,
        ]);
    }

    public function deleteFavorite(int $favoriteId)
    {
        Favorite::where('id', $favoriteId)
            ->delete();
    }

    public function getFavorite(int $favoriteId)
    {
        return Favorite::where('id', $favoriteId)
            ->first();
    }

    public function getRecipeFavorite(int $recipeId)
    {
        return Favorite::where('id_recipe', $recipeId)
            ->get();
    }

    public function getFavoriteByUserAndRecipe(int $userId, int $recipeId)
    {
        return Favorite::where('id_user', $userId)
            ->where('id_recipe', $recipeId)
            ->first();
    }

    public function toggleFavorite(int $userId, int $recipeId): bool
    {
        $existingFavorite = $this->getFavoriteByUserAndRecipe($userId, $recipeId);

        if ($existingFavorite) {
            $this->deleteFavorite($existingFavorite->id);
            return false;
        } else {
            $this->addFavorite($userId, $recipeId);
            return true;
        }
    }

    public function isRecipeInFavorites(int $userId, int $recipeId): bool
    {
        return Favorite::where('id_user', $userId)
            ->where('id_recipe', $recipeId)
            ->exists();
    }

    public function getUserFavoriteRecipes(int $userId)
    {
        return Favorite::join('recipes', 'favorites.id_recipe', '=', 'recipes.id')
            ->where('favorites.id_user', $userId)
            ->get([
                'recipes.recipename as recipename',
                'favorites.id as id',
                'favorites.id_recipe as id_recipe',
            ]);
    }
}
