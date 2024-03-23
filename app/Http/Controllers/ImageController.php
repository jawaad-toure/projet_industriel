<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\StepRepository;
use Illuminate\Support\Facades\File;
use App\Repositories\ImageRepository;
use App\Repositories\RecipeRepository;
use App\Repositories\QuantityRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $imageRepository;
    protected $recipeRepository;
    protected $quantityRepository;
    protected $stepRepository;

    public function __construct(ImageRepository $imageRepository, RecipeRepository $recipeRepository, QuantityRepository $quantityRepository, StepRepository $stepRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->recipeRepository = $recipeRepository;
        $this->quantityRepository = $quantityRepository;
        $this->stepRepository = $stepRepository;
    }

    /** controllers functions */

    /**
     * 
     */
    public function insertImages(Request $request, int $userId, int $recipeId)
    {
        $rules = [
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];

        $messages = [
            'images.*.required' => 'Vous devez ajouter une image',
            'images.*.image' => 'Le fichier doit être une image',
            'images.*.mimes' => 'Le fichier doit être de type : jpeg, png, jpg, gif',
            'images.*.max' => 'La taille du fichier ne doit pas dépasser 2 Mo',
        ];

        $validatedData = $request->validate($rules, $messages);

        try {


            if (!$request->hasFile('images'))
                return redirect()->back()->withInput()->with("image_info", "Vous n'avez ajouter aucune image");

            foreach ($validatedData['images'] as $image) {
                $extension = $image->getClientOriginalExtension();
                $hash = hash_file('sha256', $image);
                $imageName = $userId . $recipeId . $hash . '.' . $extension;
                $folder = 'uploads/recipes/';
                $imagePath = $folder . $imageName;

                if (!File::exists(public_path($imagePath))) {
                    $image->move($folder, $imageName);
                    $this->imageRepository->addImage($imagePath, $recipeId);
                }
            }       

            if ($this->quantityRepository->isRecipeQuantitiesMoreThanZero($recipeId) && $this->stepRepository->isRecipeStepsMoreThanZero($recipeId))
                $this->recipeRepository->updateField($recipeId, 'completed', true);

        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("image_warning", "Impossible d'ajouter une image");
        }

        return redirect()->back()->with('image_success', "Image.s ajoutée.s avec succès");
    }

    /**
     * 
     */
    public function deleteImage(Request $request, int $userId, int $recipeId, int $imageId)
    {
        try {
            $imagePath = $this->imageRepository->getImage($imageId)->image;
            
            $this->imageRepository->deleteImage($imageId);

            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            if (!$this->imageRepository->isRecipeImagesMoreThanZero($recipeId)) {
                $this->recipeRepository->updateField($recipeId, 'visibility', false);
                $this->recipeRepository->updateField($recipeId, 'completed', false);
            }
            
        } catch (Exception $exception) {
            
            return redirect()->back()->withInput()->with("image_warning", "Impossible de supprimer l'image");
        }

        return redirect()->back()->with('image_success', "Image supprimée avec succès");
    }
}
