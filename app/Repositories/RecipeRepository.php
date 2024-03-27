<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Recipe;
use App\Models\Quantity;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

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

    public function getRecipesForHome()
    {
        $imageSubquery = Image::select('id_recipe', DB::raw('MIN(id) as min_id'))
            ->groupBy('id_recipe');

        return Recipe::leftJoinSub($imageSubquery, 'imageSubquery', function ($join) {
            $join->on('recipes.id', '=', 'imageSubquery.id_recipe');
        })
            ->leftJoin('images', function ($join) {
                $join->on('imageSubquery.id_recipe', '=', 'images.id_recipe')
                    ->on('imageSubquery.min_id', '=', 'images.id');
            })
            ->where('recipes.visibility', '=', true)
            ->where('recipes.completed', '=', true)
            ->inRandomOrder()
            ->limit(4)
            ->get([
                'recipes.id as id',
                'recipes.recipename as recipename',
                'recipes.visibility as visibility',
                'recipes.completed as completed',
                'images.image as image',
            ]);
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

    public function getRecipesRelatedTo(string $search)
    {
        $imageSubquery = Image::select('id_recipe', DB::raw('MIN(id) as min_id'))
            ->groupBy('id_recipe');

        return Recipe::where('recipes.recipename', 'like', '%' . $search . '%')
            ->orWhere('recipes.cookingtype', 'like', '%' . $search . '%')
            ->orWhere('recipes.difficulty', 'like', '%' . $search . '%')
            ->orWhere('recipes.category', 'like', '%' . $search . '%')
            ->leftJoinSub($imageSubquery, 'imageSubquery', function ($join) {
                $join->on('recipes.id', '=', 'imageSubquery.id_recipe');
            })
            ->leftJoin('images', function ($join) {
                $join->on('imageSubquery.id_recipe', '=', 'images.id_recipe')
                    ->on('imageSubquery.min_id', '=', 'images.id');
            })
            ->get([
                'recipes.id as id',
                'recipes.recipename as recipename',
                'recipes.cookingtype as cookingtype',
                'recipes.category as category',
                'recipes.difficulty as difficulty',
                'recipes.visibility as visibility',
                'recipes.completed as completed',
                'recipes.time as time',
                'images.image as image',
            ]);
    }
}
