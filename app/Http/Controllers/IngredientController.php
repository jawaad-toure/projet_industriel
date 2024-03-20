<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UnitRepository;
use App\Repositories\IngredientRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IngredientController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $ingredientRepository;
    protected $unitRepository;

    public function __construct(IngredientRepository $ingredientRepository, UnitRepository $unitRepository) 
    {
        $this->ingredientRepository = $ingredientRepository;
        $this->unitRepository = $unitRepository;
    }

    /** views preview function */

    public function showIngredientsForm(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect()
                ->route('signin.show');
        }

        $ingredients = $this->ingredientRepository->getIngredients();
        $units = $this->unitRepository->getUnits();

        return view('ingredients/ingredient_create_form', ['ingredients' => $ingredients, 'units' => $units]);
    }

    /** controllers functions */

    public function insertIngredients(Request $request, int $userId)
    {
        $rules = [
            'ingredientname' => ['required'],
            'quantity' => ['required'],
            'unitname' => ['required'],
        ];

        $messages = [
            'ingredientname.*.required' => 'Vous devez ajouter un ingrédient',
            'quantity.*.required' => 'Vous devez ajouter une quantité',
            'unitname.*.required' => 'Vous devez ajouter une unité',
        ];

        $validatedData = $request->validate($rules, $messages);

        // dump($validatedData);

        return redirect()->back()->withInput()->with('ingredient_success', "Ingrédient.s ajouté.s avec succès");

    }
    
}
