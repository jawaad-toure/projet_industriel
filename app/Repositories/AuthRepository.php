<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    /**
     * 
     */
    public function addUser(string $username, string $email, string $password): int
    {
        $passwordHashed = Hash::make($password);

        $userId = DB::table("users")
            ->insertGetId([
                "username" => $username,
                "email" => $email,
                "password" => $passwordHashed
            ]);

        return $userId;
    }

    /**
     * 
     */
    public function getUser(string $email): array
    {
        $user = DB::table("users")
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw new Exception("Utilisateur inconnu");
        }

        return [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'birthdate' => $user->birthdate,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'password' => $user->password,
            'profile_picture' => $user->profile_picture
        ];
    }

    /**
     * 
     */
    public function doPasswordsMatch(string $dbPassword, string $signinPassword): bool
    {
        if (Hash::check($signinPassword, $dbPassword))
            return true;
        return false;
    }

    /** 
     * 
     */
    public function updateField(string $email, string $field, string $value)
    {
        DB::table("users")
            ->where("email", $email)
            ->update([$field => $value]);
    }

    /**
     * 
     */
    public function hashNewPassword(string $email, string $oldPassword, string $newPassword)
    {
        $user = $this->getUser($email);

        if (!$this->doPasswordsMatch($user['password'], $oldPassword))
            throw new Exception("Mot de passe incorrect !");

        return Hash::make($newPassword);
    }

    /**
     * 
     */
    public function deleteUser(string $email) 
    {
        DB::table("users")
            ->where("email", $email)
            ->delete();
    }

    /** codes repetition to delete */

    // public function changeFirstname(string $email, string $newFirstname): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['firstname' => $newFirstname]);
    // }

    // public function changeLastname(string $email, string $newLastname): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['lastname' => $newLastname]);
    // }

    // public function changeBirthdate(string $email, string $newBirthdate): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['birthdate' => $newBirthdate]);
    // }

    // public function changeUsername(string $email, string $newUsername): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['username' => $newUsername]);
    // }

    // public function changeEmail(string $email, string $newEmail): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['email' => $newEmail]);
    // }

    // public function changePhone(string $email, string $newPhone): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['phone' => $newPhone]);
    // }

    // public function changeAddress(string $email, string $newAddress): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['address' => $newAddress]);
    // }

    // public function changePassword(string $email, string $oldPassword, string $newPassword): void
    // {
    //     $user = $this->getUser($email);

    //     if (!$this->doPasswordsMatch($user['password'], $oldPassword))
    //         throw new Exception("Mot de passe incorrect !");

    //     $newPasswordHashed =  Hash::make($newPassword);

    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['password' => $newPasswordHashed]);
    // }

    // public function changeProfilPicture(string $email, string $newProfilePicture): void
    // {
    //     DB::table("users")
    //         ->where("email", $email)
    //         ->update(['profile_picture' => $newProfilePicture]);
    // }
}
