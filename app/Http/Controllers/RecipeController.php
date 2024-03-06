<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RecipeRepository;

class RecipeController extends Controller
{
    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * Delete a recipe whose id have been specified from DB
     * 
     * @param int $recipeId
     */
    public function deleteRecipe(Request $request, int $recipeId)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }
        $this->recipeRepository->deleteRecipe($recipeId);
    }
}
