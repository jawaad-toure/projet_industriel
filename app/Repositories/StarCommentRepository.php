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


    public function getStarsComments(int $id_recipe)
    {
        return StarComment::join('users', 'stars_comments.id_user', '=', 'users.id')
            ->where('id_recipe', $id_recipe)
            ->get([
                'stars_comments.stars as stars',
                'stars_comments.comment as comment',
                'users.username as username',
                'users.avatar as avatar',
            ]);
    }


    public function getAverageStars(int $id_recipe)
    {
        return StarComment::where('id_recipe', $id_recipe)
            ->whereNotNull('stars')
            ->avg('stars');
    }



    public function getStarComment(int $starCommentId)
    {
        return StarComment::where('id', $starCommentId)
            ->first();
    }


    public function getCommentsCount(int $id_recipe)
    {
        return StarComment::where('id_recipe', $id_recipe)
            ->whereNotNull('comment')
            ->count();
    }


    public function getStarCommentId(string $comment, int $id_user)
    {
        $starComment = StarComment::firstOrCreate([
            'comment' => $comment,
            'id_user' => $id_user,
        ]);

        return $starComment->id;
    }
}
