<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UnitRepository;
use App\Repositories\QuantityRepository;
use App\Repositories\IngredientRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuantityController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $quantityRepository;
    protected $ingredientRepository;
    protected $unitRepository;
    

    public function __construct(QuantityRepository $quantityRepository, IngredientRepository $ingredientRepository, UnitRepository $unitRepository)
    {
        $this->quantityRepository = $quantityRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->unitRepository = $unitRepository;
    }

    /** controllers functions */

    /**
     * Add quantity in DB
     */
    public function insertQuantity(Request $request, int $userId, int $recipeId)
    {
        $rules = [
            'ingredientname' => ['required'],
            'quantity' => ['required'],
            'unitname' => ['required', 'regex:/^\p{L}+$/u'],
        ];

        $messages = [
            'ingredientname.required' => "Vous devez renseigner un ingrédient",
            'quantity.required' => "Vous devez renseigner une quantité",
            'unitname.required' => "Vous devez renseigner une unité",
            'unitname.regex' => "Vous devez saisir une unité valide",
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            if (!$this->ingredientRepository->doesIngredientExist($validatedData['ingredientname']))
                $this->ingredientRepository->addIngredient(ucfirst($validatedData['ingredientname']));

            if (!$this->unitRepository->doesUnitExist($validatedData['unitname']))
                $this->unitRepository->addUnit(ucfirst($validatedData['unitname']));

            $unitId = $this->unitRepository->getUnitId($validatedData['unitname']);
            $ingredientId = $this->ingredientRepository->getIngredientId($validatedData['ingredientname']);

            $this->quantityRepository->addQuantity($validatedData['quantity'], $unitId, $ingredientId, $recipeId);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with('quantity_warning', "Impossible d'ajouter l'ingrédient");
        }

        return redirect()->back()->with('quantity_success', "Ingrdient ajouté avec succès");
    }


    /**
     * 
     */
    public function updateQuantity(Request $request, int $userId, int $recipeId, int $quantityId)
    {
        $rules = [
            'ingredientname_to_update' => ['required'],
            'quantity_to_update' => ['required'],
            'unitname_to_update' => ['required', 'regex:/^[A-Za-z]+$/'],
        ];

        $messages = [
            'ingredientname_to_update.required' => "Vous devez renseigner un ingrédient",
            'quantity_to_update.required' => "Vous devez renseigner une quantité",
            'unitname_to_update.required' => "Vous devez renseigner une unité",
            'unitname_to_update.regex' => "Vous devez saisir une unité valide",
        ];

        $validatedData = $request->validate($rules, $messages);

        $quantityRetrieveData = [];

        try {
            $quantity = $this->quantityRepository->getQuantity($quantityId);
            $quantityRetrieveData['ingredientname'] = $this->ingredientRepository->getIngredient($quantity->id_ingredient)->ingredientname;
            $quantityRetrieveData['quantity'] = $quantity->quantity;
            $quantityRetrieveData['unitname'] = $this->unitRepository->getUnit($quantity->id_unit)->unitname;

            if ($validatedData['ingredientname_to_update'] !== $quantityRetrieveData['ingredientname'])
                $this->quantityRepository->updateIdIngredient($quantityId,$recipeId, $this->ingredientRepository->getIngredientId($validatedData['ingredientname_to_update']));

            if ($validatedData['quantity_to_update'] !== $quantityRetrieveData['quantity'])
                $this->quantityRepository->updateQuantity($quantityId, $recipeId, $validatedData['quantity_to_update']);

            if ($validatedData['unitname_to_update'] !== $quantityRetrieveData['unitname'])
                $this->quantityRepository->updateIdUnit($quantityId, $recipeId, $this->unitRepository->getUnitId($validatedData['unitname_to_update']));
            
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("quantity_warning", "Impossible de modifier l'ingrédient");
        }

        return redirect()->back()->with('quantity_success', "Ingrdient modifié avec succès");
    }


    /**
     * 
     */
    public function deleteQuantity(Request $request, int $userId, int $recipeId, int $quantityId)
    {
        try {
           $this->quantityRepository->deleteQuantity($quantityId, $recipeId); 
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->with("quantity_warning", "Impossible de supprimer l'ingrédient");
        }

        return redirect()->back()->with('quantity_success', "Ingrdient supprimé avec succès");
    }

}
