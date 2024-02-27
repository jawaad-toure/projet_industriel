<?php

namespace App\Http\Controllers;

use Exception;
use App\Repositories\AuthRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $authRepository;

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }

    public function showSignupForm(): View {
        return view('signup');
    }

    public function signup(Request $request, AuthRepository $authRepository) {
        $rules = [
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
        ];

        $messages = [
            'username.required' => 'Vous devez saisir un pseudonyme',
            'username.string' => 'Vous devez saisir un pseudonyme valide.',
            'username.unique' => "Cet pseudonyme n'est plus disponible.",
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.unique' => "Cet utilisateur existe déjà.",
            'password.required' => 'Vous devez saisir un mot de passe.',
            'password.min' => "Votre mot de passe doit-être d'au moins 8 caractères.",
            'password.confirmed' => 'Votre mot de passe de confirmation ne correspond pas.'
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $this->authRepository->addUser(
                $validatedData['username'],
                $validatedData['email'], 
                $validatedData['password']
            );
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de créer un compte.");
        }

        return redirect()->route('signin.show')->with('success', 'Compte créé avec succès !');
    }

    public function showSigninForm(): View {
        return view('signin');
    }
}
