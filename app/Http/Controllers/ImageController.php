<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
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
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("image_warning", "Impossible de supprimer l'image");
        }

        return redirect()->back()->with('image_success', "Image supprimée avec succès");
    }
}
