<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\File;
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

    public function showSignupForm() 
    {
        return view('auth/signup');
    }
    
    public function showSignupVerify() 
    {
        return view('auth/signup_verify');
    }

    public function showUserDashboard(Request $request, int $userId) 
    {
        if(!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }

        $user = $this->authRepository->getUser($request->session()->get('user')['email']);
        
        return view('users/user_dashboard', ['user' => $user]);
    }

    public function showUserInformationsForm(Request $request, int $userId) 
    {
        if(!$request->session()->has('user')) {
            return redirect()->route('signin.show');
        }

        return view('users/user_infos_update');
    }

    public function showSigninForm() 
    {
        return view('auth/signin');
    }

    /** controllers functions */

    /**
     * 
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


    /**
     * 
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

            if (!$this->authRepository->doPasswordsMatch($user['password'], $validatedData['password']))
                throw new Exception("Utilisateur inconnu");

            $request->session()->put('user', $user);
        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de vous authentifier.");
        }
        return redirect()->route('user.dashboard.show', ['userId' => $request->session()->get('user')['id']]);
    }

    /**
     * 
     */
    public function logout(Request $request) 
    {
        $request->session()->forget('user');
        return redirect()->route('signin.show');
    }

    /**
     * 
     */
    public function updateUserInformations(Request $request, $userId) 
    {
        $rules = [
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'username' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'password' => ['nullable'],
            'new_password' => ['nullable', 'min:8', 'max:20', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'password_confirmed' => ['nullable'],
            'profile_picture' => ['nullable']
        ];

        $messages = [
            'firstname.string' => "Le prénom n'est pas valide.",
            'lastname.string' => "Le nom n'est pas valide.",
            'birthdate.date' => "La date de naissance n'est pas valide.",
            'username.string' => "Le pseudonyme n'est pas valide.",
            'email.email' => "L'email n'est pas valide.",
            'phone.string' => "Le numéro de téléphone n'est pas valide.",
            'new_password.min' => "Le mot de passe doit-être d'au moins 8 caractères.",
            'new_password.max' => "Le mot de passe doit-être d'au plus 20 caractères.",
            'new_password.regex' => 'Le mot de passe doit contenir au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.'
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = $this->authRepository->getUser($validatedData['email']);

        try {

            foreach ($validatedData as $key => $value) {                

                if(isset($validatedData[$key]) && $value != $user[$key]) {
                    if (in_array($key, array('email', 'username'))) {
                        $request->validate(['$key' => ['unique:users,$key']]);
                    }

                    if (strcmp($key, "password") == 0) {
                        $request->validate(['password_confirmed' => ['same:new_password']]);
                        $value = $this->authRepository->hashNewPassword($user['email'], $value, $validatedData['new_password']);
                    }

                    if (strcmp($key, "profile_picture") == 0 && $request->hasFile($key)) {
                        $file = $request->file('profile_picture');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time().'.'.$extension;
                        $path = 'uploads/profile_picture/';
                        $file->move($path, $filename);
                        
                        if (File::exists($user['profile_picture'])) {
                            File::delete($user['profile_picture']);
                        }

                        $value = $path.$filename;
                    }

                    $this->authRepository->updateField($user['email'], $key, $value);
                    $request->session()->put('user.'.$key, $value);

                    if (strcmp($key, "password") == 0) {
                        $this->logout($request);
                    }
                }
            }

            /** codes repetition to delete */
            // if (isset($validatedData['firstname']) && $validatedData['firstname'] != $user['firstname']) {
            //     $this->authRepository->changeFirstname($user['email'], $validatedData['firstname']);
            //     $request->session()->put('user.firstname', $validatedData['firstname']);
            // }

            // if (isset($validatedData['lastname']) && $validatedData['lastname'] != $user['lastname']) {
            //     $this->authRepository->changeLastname($user['email'], $validatedData['lastname']);
            //     $request->session()->put('user.lastname', $validatedData['lastname']);
            // }

            // if (isset($validatedData['birthdate']) && $validatedData['birthdate'] != $user['birthdate']) {
            //     $this->authRepository->changeBirthdate($user['email'], $validatedData['birthdate']);
            //     $request->session()->put('user.birthdate', $validatedData['birthdate']);
            // }

            // if (isset($validatedData['username']) && $validatedData['username'] != $user['username']) {
            //     $request->validate(['username' => ['unique:users,username']], ['username.unique' => "Cet pseudonyme n'est plus disponible."]);
            //     $this->authRepository->changeUsername($user['email'], $validatedData['username']);
            //     $request->session()->put('user.username', $validatedData['username']);
            // }

            // if (isset($validatedData['email']) && $validatedData['email'] != $user['email']) {
            //     $request->validate(['email' => ['unique:users,email']], ['email.unique' => "Cet utilisateur existe déjà."]);
            //     $this->authRepository->changeEmail($user['email'], $validatedData['email']);
            //     $request->session()->put('user.email', $validatedData['email']);
            // }

            // if (isset($validatedData['phone']) && $validatedData['phone'] != $user['lastname']) {
            //     $this->authRepository->changePhone($user['email'], $validatedData['phone']);
            //     $request->session()->put('user.phone', $validatedData['phone']);
            // }

            // if (isset($validatedData['address']) && $validatedData['address'] != $user['address']) {
            //     $this->authRepository->changeAddress($user['email'], $validatedData['address']);
            //     $request->session()->put('user.address', $validatedData['address']);
            // }

            // if ($request->hasFile('profile_picture') && $validatedData['profile_picture'] != $user['profile_picture']) {
            //     $file = $request->file('profile_picture');
            //     $extension = $file->getClientOriginalExtension();
            //     $filename = time().'.'.$extension;
            //     $path = 'uploads/profile_picture/';
            //     $file->move($path, $filename);
                
            //     if (File::exists($user['profile_picture'])) {
            //         File::delete($user['profile_picture']);
            //     }

            //     $file_path = $path.$filename;
            //     $this->authRepository->changeProfilPicture($user['email'], $file_path);
            //     $request->session()->put('user.profile_picture', $file_path);
            // }

            // if (isset($validatedData['password']) && $validatedData['password'] != $user['password']) {
            //     $request->validate(['password_confirmed' => ['same:new_password']], ['password_confirmed.same' => "Le mot de passe n'est pas conforme."]);
            //     $this->authRepository->changePassword($user['email'], $validatedData['password'], $validatedData['new_password']);
            //     $request->session()->put('user.password', $validatedData['password']);
            //     $this->logout($request);
            // }

        } catch (Exception $exception) {
            return redirect()->back()->withInput()->withErrors("Impossible de faire la mise à jour.");
        }

        return redirect()->back();
    }

    /**
     * 
     */
    public function deleteUser(Request $request, $userId)
    {
        $user = $this->authRepository->getUser($request->session()->get('user')['email']);
        $request->session()->forget('user');
        $this->authRepository->deleteUser($user['email']);
        return redirect()->route('signin.show');     
    }
}
