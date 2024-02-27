<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    /**
     * Create one user using username, email and password
     * @param string $username of user
     * @param string $email of user
     * @param string $password of user
     * @return int user created id
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
     * Find one user using his email
     * @param string $email of user
     * @param string $password of user
     * @return array of user id and user email
     */
    function getUser(string $email, string $password): array {
        $user = DB::table("users")
                    ->where('email', $email)
                    ->first();
  
        if (!$user) {
           throw new Exception("Utilisateur inconnu");
        }
        
        $passwordHashed = $user['password'];
        
        $doPasswordsMatch = Hash::check($password, $passwordHashed);
        
        if (!$doPasswordsMatch) {
           throw new Exception("Utilisateur inconnu");
        }
  
        return ['id' => $user['id'], 'email' => $user['email']];
    }
}