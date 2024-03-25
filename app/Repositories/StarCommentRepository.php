<?php

namespace App\Repositories;

use App\Models\StarComment;

final class StarCommentRepository
{

    public function addStarComment(int $stars, string|null $comment, int $recipeId, int $userId)
    {
        StarComment::create([
            'stars' => $stars,
            'comment' => $comment,
            'id_recipe' => $recipeId,
            'id_user' => $userId,
        ]);
    }


    public function getStarsComments(int $recipeId)
    {
        return StarComment::join('users', 'stars_comments.id_user', '=', 'users.id')
            ->where('id_recipe', $recipeId)
            ->get([
                'stars_comments.stars as stars',
                'stars_comments.comment as comment',
                'users.username as username',
                'users.avatar as avatar',
            ]);
    }


    public function getAverageStars(int $recipeId)
    {
        return StarComment::where('id_recipe', $recipeId)
            ->whereNotNull('stars')
            ->avg('stars');
    }


    public function getUserRecipesCommented(int $userId)
    {
        return StarComment::join('recipes', 'stars_comments.id_recipe', '=','recipes.id')
            ->where('stars_comments.id_user', $userId)
            ->whereNotNull('comment')
            ->get([
               'recipes.recipename as recipename',
               'stars_comments.id as id',
            ]);
    }


    public function getStarComment(int $starCommentId)
    {
        return StarComment::where('id', $starCommentId)
            ->first();
    }


    public function getCommentsCount(int $recipeId)
    {
        return StarComment::where('id_recipe', $recipeId)
            ->whereNotNull('comment')
            ->count();
    }


    public function getStarCommentId(string $comment, int $userId)
    {
        $starComment = StarComment::firstOrCreate([
            'comment' => $comment,
            'id_user' => $userId,
        ]);

        return $starComment->id;
    }


    public function hasUserAlreadyRatedThisRecipe(int $recipeId, int $userId)
    {
        return StarComment::where('id_recipe', $recipeId)
            ->where('id_user', $userId)
            ->exists();
    }


    public function deleteStarComment(int $starCommentId)
    {
        StarComment::where('id', $starCommentId)
            ->delete();
    }
}
