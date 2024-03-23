<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\RecipeRepository;
use App\Repositories\StarCommentRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StarCommentController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $starCommentRepository;
    protected $recipeRepository;

    public function __construct(StarCommentRepository $starCommentRepository, RecipeRepository $recipeRepository)
    {
        $this->starCommentRepository = $starCommentRepository;
        $this->recipeRepository = $recipeRepository;
    }


    /** views preview function */

    /**
     * 
     */
    public function showStarCommentForm(int $recipeId)
    {
        return view('stars_comments/star_comment_form', ['recipeId' => $recipeId]);
    }


    /** controllers functions */

    /**
     * 
     */
    public function insertStarComment(Request $request, int $recipeId)
    {
        $rules = [
            'rating' => ['required'],
            'comment' => ['nullable', 'max:255'],
        ];

        $messages = [
            'rating.required' => 'Vous devez sélectionner une note',
            'comment.max' => "Votre commentaire n'est pas dépasse 255 charactères",
        ];

        $validatedData = $request->validate($rules, $messages);

        // dump($validatedData);


        try {
            $userId = $this->recipeRepository->getRecipe($recipeId)->id_user;

            if (!isset($validatedData['rating']) || $validatedData['rating'] == 0)
                return redirect()->back()->withInput()->with("star_comment_info", "Vous devez sélectionner une note");

            $this->starCommentRepository->addStarComment(
                intval($validatedData['rating']),
                $validatedData['comment'],
                $userId,
                $recipeId,
            );

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with("star_comment_warning", "Echec de l'ajout de votre évaluation");
        }

        return redirect()->back()->with('star_comment_success', "Votre évaluation a été bien prise en compte");
    }
}
