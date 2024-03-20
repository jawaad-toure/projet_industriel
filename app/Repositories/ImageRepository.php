<?php

namespace App\Repositories;

use App\Models\Image;

final class ImageRepository
{
    public function addImage(string $imagePath, int $recipeId)
    {
        Image::create([
           'image' => $imagePath,
           'id_recipe' => $recipeId,
        ]);
    }

    public function getImage(int $imageId)
    {
        return Image::where('id', $imageId)
            ->first();
    }

    public function getRecipeImages(int $recipeId)
    {
        return Image::where('id_recipe', $recipeId)
            ->get();
    }

    public function isRecipeImagesMoreThanZero(int $recipeId)
    {
        return $this->getRecipeImages($recipeId)->count() > 0;
    }

    public function deleteImage(int $imageId)
    {
        Image::where('id', $imageId)
            ->delete();
    }

    public function deleteRecipeImages(int $recipeId)
    {
        Image::where('id_recipe', $recipeId)
            ->delete();
    }
}