<?php

namespace App\Repositories;

use App\Models\Step;

final class StepRepository
{
    public function addStep(string $description, int $recipId)
    {
        Step::create([
            'description' => $description,
            'id_recipe' => $recipId,
        ]);
    }

    public function getRecipeSteps(int $recipeId)
    {
        return Step::where('id_recipe', $recipeId)
            ->get();
    }

    public function isRecipeStepsMoreThanZero(int $recipeId)
    {
        return $this->getRecipeSteps($recipeId)->count() > 0;
    }

    public function getRecipeStep(int $stepId, int $recipeId)
    {
        return Step::where('id', $stepId)
            ->where('id_recipe', $recipeId)
            ->first();
    }

    public function updateStep(string $description, int $stepId, int $recipeId)
    {
        Step::where('id', $stepId)
            ->where('id_recipe', $recipeId)
            ->update(['description' => $description]);
    }

    public function deleteStep(int $stepId, int $recipeId)
    {
        Step::where('id', $stepId)
            ->where('id_recipe', $recipeId)
            ->delete();
    }

    public function deleteRecipeSteps(int $recipeId)
    {
        Step::where('id_recipe', $recipeId)
            ->delete();
    }
}
