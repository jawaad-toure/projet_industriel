<?php

namespace App\Repositories;

use Exception;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    
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
            'avatar' => $user->avatar ?? 'uploads/avatars/default_avatar.png'
        ];
    }

    
    
    public function doPasswordsMatch(string $dbPassword, string $password): bool
    {
        return Hash::check($password, $dbPassword);
    }

    
    
    public function updateField(string $email, string $field, string|null $value)
    {
        DB::table("users")
            ->where("email", $email)
            ->update([$field => $value]);

        // User::where("email", $email)
        //     ->update([$field => $value]);
    }

    
    
    public function hashNewPassword(string $email, string $oldPassword, string $newPassword)
    {
        $user = $this->getUser($email);

        if (!$this->doPasswordsMatch($user['password'], $oldPassword))
            throw new Exception("Mot de passe incorrect !");

        return Hash::make($newPassword);
    }

    
    
    public function deleteUser(int $userId) 
    {
        DB::table("users")
            ->where("id", $userId)
            ->delete();

        // User::where("id", $userId)
        //     ->delete();
    }

}
