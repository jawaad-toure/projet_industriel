<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;
use App\Repositories\QuantityRepository;
use App\Repositories\RecipeRepository;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\StepRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StepController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $stepRepository;
    protected $quantityRepository;
    protected $imageRepository;
    protected $recipeRepository;

    public function __construct(StepRepository $stepRepository, RecipeRepository $recipeRepository, ImageRepository $imageRepository, QuantityRepository $quantityRepository)
    {
        $this->stepRepository = $stepRepository;
        $this->imageRepository = $imageRepository;
        $this->quantityRepository = $quantityRepository;
        $this->recipeRepository = $recipeRepository;
    }

    /** views preview function */

    /**
     * 
     */
    public function insertStep(Request $request, int $userId, int $recipeId)
    {
        $rules = [
            'description_to_add' => ['required']
        ];

        $messages = [
            'description_to_add.required' => "Vous devez saisir une description de l'étape",
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            
            $this->stepRepository->addStep($validatedData['description_to_add'], $recipeId);

            if ($this->imageRepository->isRecipeImagesMoreThanZero($recipeId) && $this->quantityRepository->isRecipeQuantitiesMoreThanZero($recipeId))
                $this->recipeRepository->updateField($recipeId, 'completed', true);

        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("step_warning", "Impossible d'ajouter une étape");
        }

        return redirect()->back()->with('step_success', "Etape ajoutée avec succès");
    }


    public function updateStep(Request $request, int $userId, int $recipeId, int $stepId)
    {
        
        $rules = [
            'description_to_update' => ['required']
        ];

        $messages = [
            'description_to_update.required' => "Vous devez saisir une description de l'étape",
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $recipeStepDescription = $this->stepRepository->getRecipeStep($stepId, $recipeId)->description;

            if (strcmp($recipeStepDescription, $validatedData['description_to_update']) == 0)
                return redirect()->back()->with("step_info", "Aucune modification effecuée dans la description de cette étape");
            else
                $this->stepRepository->updateStep($validatedData['description_to_update'], $stepId, $recipeId);

        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("step_warning", "Impossible de modifier l'étape");
        }

        return redirect()->back()->with('step_success', "Etape modifiée avec succès");
    }


    /**
     * 
     */
    public function deleteStep(Request $request, int $userId, int $recipeId, int $stepId)
    {
        try {
            $this->stepRepository->deleteStep($stepId, $recipeId);

            if (!$this->stepRepository->isRecipeStepsMoreThanZero($recipeId)) {
                $this->recipeRepository->updateField($recipeId, 'visibility', false);
                $this->recipeRepository->updateField($recipeId, 'completed', false);
            }
            
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("step_warning", "Impossible de supprimer l'étape");
        }

        return redirect()->back()->with('step_success', "Etape supprimée avec succès");
    }
}
