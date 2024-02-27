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
    
    public function showSignupVerify() {
        return view('signup_verify');
    }

    public function signup(Request $request, AuthRepository $authRepository) {
        $rules = [
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:20', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmed' => ['required', 'same:password']
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
            'password.max' => "Votre mot de passe doit-être d'au plus 20 caractères.",
            'password.regex' => 'Votre mot de passe doit contenir au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.',
            'password_confirmed.required' => 'Vous devez confirmer le mot de passe.',
            'password_confirmed.same' => "Votre mot de passe n'est pas conforme."

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

        return redirect()->route('signup.verify');
    }

    public function showSigninForm(): View {
        return view('signin');
    }
}
