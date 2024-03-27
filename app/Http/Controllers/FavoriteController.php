<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\FavoriteRepository;

class FavoriteController extends Controller
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function addFavorite(Request $request, int $recipeId)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }

        try {
            $userId = $request->session()->get('user')['id'];

            $isFavorite = $this->favoriteRepository->toggleFavorite($userId, $recipeId);

            if (!$isFavorite) {
                return redirect()->back();
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Une erreur s'est produite lors de l'ajout du favori");
        }

        return redirect()->back();
    }

    public function deleteFavorite(int $userId, int $favoriteId)
    {
        try {
            $this->favoriteRepository->deleteFavorite($favoriteId);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with("favorite_warning", "Echec de la suppression de votre favorit");
        }

        return redirect()->back()->with('favorite_success', "Votre favoris a été bien supprimé");
    }
}
