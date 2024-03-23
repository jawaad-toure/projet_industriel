<?php

namespace App\Repositories;

use App\Models\StarComment;

final class StarCommentRepository
{
    
    public function addStarComment(string $stars, string $comment, int $id_recipe, int $id_user)
    {
        StarComment::create([
            'stars' => $stars,
            'comment' => $comment,
            'id_recipe' => $id_recipe,
            'id_user' => $id_user,
        ]);
    }


    public function getStarComment(int $starCommentId)
    {
        return StarComment::where('id', $starCommentId)
            ->first();
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
