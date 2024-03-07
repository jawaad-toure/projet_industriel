<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Mail\ConfirmSignupMail;
use Illuminate\Support\Facades\DB;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /** views preview function */

    public function showHome()
    {
        return view('home');
    }

    public function showSignupForm()
    {
        return view('auth/signup');
    }

    public function showSignupVerify(int $userId)
    {
        return view('auth/signup_email_verify', ['userId' => $userId]);
    }

    public function showUserDashboard(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }

        $user = $this->authRepository->getUser($request->session()->get('user')['email']);

        return view('users/user_dashboard', ['user' => $user]);
    }

    public function showUserInformationsForm(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }

        return view('users/user_infos_update');
    }

    public function showSigninForm()
    {
        return view('auth/signin');
    }

    public function showSigninFirstTime(int $userId)
    {
        $this->authRepository->updateField($userId, 'email_verified_at', now());
        return view('auth/signin');
    }

    /** controllers functions */

    /**
     * Send email validation
     */
    public function sendEmailValidation(Request $request, int $userId)
    {
        $email = $this->authRepository->getUser($userId)['email'];
        Mail::to($email)->send(new ConfirmSignupMail($userId));
        return redirect()->back();
    }

    /**
     * Add user to DB
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function signup(Request $request)
    {
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

        DB::beginTransaction();

        try {
            $this->authRepository->addUser($validatedData['username'], $validatedData['email'], $validatedData['password']);
            $userAdded = $this->authRepository->getUser($validatedData['email']);           
            $this->sendEmailValidation($request, $userAdded["id"]);
            // Mail::to($validatedData['email'])->send(new ConfirmSignupMail($userAddedId));
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors("Impossible de créer un compte.");
        }

        return redirect()->route('signup.verify', ['userId' => $userAdded["id"]]);
    }

    /**
     * Signin user
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function signin(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ];

        $messages = [
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.exists' => "Cet utilisateur n'existe pas.",
            'password.required' => "Vous devez saisir un mot de passe.",
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $user = $this->authRepository->getUser($validatedData['email']);
            $this->authRepository->doPasswordsMatch($user['password'], $validatedData['password']);                
            if ($this->authRepository->isEmailVerified($user["id"])) {
                $this->sendEmailValidation($request, $user["id"]);
                return redirect()->route('signup.verify', ['userId' => $user["id"]]);
            }
            $request->session()->put('user', $user);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de vous authentifier.");
        }
        return redirect()->route('user.dashboard.show', ['userId' => $request->session()->get('user')['id']]);
    }

    /**
     * Logout user
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('signin.show');
    }


    /**
     * Update user firstname, lastname, username, address, phone, birthdate
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function updateInformations(Request $request)
    {
        $rules = [
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'username' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string']
        ];

        $messages = [
            'firstname.string' => "Le prénom n'est pas valide.",
            'lastname.string' => "Le nom n'est pas valide.",
            'birthdate.date' => "La date de naissance n'est pas valide.",
            'username.string' => "Le pseudonyme n'est pas valide.",
            'phone.string' => "Le numéro de téléphone n'est pas valide.",
            'address.string' => "L'adresse n'est pas valide."
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = $this->authRepository->getUser($request->session()->get('user')['email']);

        try {
            foreach ($validatedData as $key => $value) {
                if (isset($validatedData[$key]) && $value != $user[$key]) {
                    $this->authRepository->updateField($user['email'], $key, $value);
                    $request->session()->put('user.' . $key, $value);
                }
            }
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de modifier vos informations.");
        }

        return redirect()->back();
    }

    /**
     * Update user email
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function updateEmail(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'unique:users,email']
        ];

        $messages = [
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.unique' => "Cet utilisateur existe déjà."
        ];

        $validatedData = $request->validate($rules, $messages);
        
        try {
            $user = $this->authRepository->getUser($request->session()->get('user')['email']);
            $this->authRepository->updateField($user['email'], 'email', $validatedData['email']);
            $request->session()->put('user.email', $validatedData['email']);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de modifier l'email.");
        }

        return redirect()->back();
    }

    /**
     * Update user password
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:20', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmed' => ['required', 'same:new_password']
        ];

        $messages = [
            'password.required' => 'Vous devez saisir le mot de passe actuel.',
            'new_password.required' => 'Vous devez saisir le nouveau mot de passe.',
            'new_password.min' => "Le mot de passe doit-être d'au moins 8 caractères.",
            'new_password.max' => "Le mot de passe doit-être d'au plus 20 caractères.",
            'new_password.regex' => 'Le mot de passe doit contenir au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.',
            'password_confirmed.required' => 'Vous devez confirmer le nouveau mot de passe.',
            'password_confirmed.same' => "Votre mot de passe n'est pas conforme."
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = $this->authRepository->getUser($request->session()->get('user')['email']);

        try {
            $value = $this->authRepository->hashNewPassword($user['email'], $validatedData['password'], $validatedData['new_password']);
            $this->authRepository->updateField($user['email'], 'password', $value);
            $this->logout($request);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de modifier le mot de passe.");
        }

        return redirect()->back();
    }

    /**
     * Update user avatar
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function updateAvatar(Request $request)
    {
        $rules = [
            'avatar' => ['required']
        ];

        $messages = [
            'avatar.required' => "Vous devez choisir un avatar."
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = $this->authRepository->getUser($request->session()->get('user')['email']);

        try {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/avatars/';
            $file->move($path, $filename);

            if (File::exists($user['avatar']) && strcmp($user['avatar'], "uploads/avatars/default_avatar.png") != 0) {
                File::delete($user['avatar']);
            }

            $value = $path . $filename;

            $this->authRepository->updateField($user['email'], 'avatar', $value);
            $request->session()->put('user.avatar', $value);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de modifier l'avatar.");
        }

        return redirect()->back();
    }

    /**
     * Delete user avatar
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function deleteAvatar(Request $request)
    {
        ['email' => $userEmail, 'avatar' => $userAvatar] = $this->authRepository->getUser($request->session()->get('user')['email']);
        $this->authRepository->updateField($userEmail, 'avatar', null);
        if (strcmp($userAvatar, "uploads/avatars/default_avatar.png") != 0) {
            File::delete($userAvatar);
        }
        $request->session()->put('user.avatar', $this->authRepository->getUser($userEmail)['avatar']);
        return redirect()->back();
    }

    /**
     * Delete User whose id have been specified from DB
     * 
     * @param Request $request
     * @param int $userId 
     */
    public function deleteUser(Request $request, int $userId)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }
        $request->session()->forget('user');
        $this->authRepository->deleteUser($userId);
        return redirect()->route('signin.show');
    }
}
