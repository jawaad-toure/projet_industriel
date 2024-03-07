<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class AuthRepository
{

    /**
     * Add user to DB with his username, email and password
     * 
     * @param string $username
     * @param string $email
     * @param string $password
     * 
     * @return int
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
     * Get user from DB with email
     * 
     * @param string $email
     * 
     * @return array 
     */
    public function getUser(string|int $with): array
    {
        if (is_string($with)) {
            $user = DB::table("users")
                ->where('email', $with)
                ->first();
        } else {
            $user = DB::table("users")
                ->where('id', $with)
                ->first();
        }

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
            'avatar' => $user->avatar ?? 'uploads/avatars/default_avatar.png',
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }


    /**
     * Check if user actual password match to password enter in input
     * 
     * @param string $dbPassword
     * @param string $password
     * 
     * @return boolean
     */
    public function doPasswordsMatch(string $dbPassword, string $password): void
    {
        if (!Hash::check($password, $dbPassword)) {
            throw new Exception("Mot de passe incorrect.");
        }
    }

    /**
     * Check if user email is verified
     */
    public function isEmailVerifiedAtNull(int $id): bool
    {
        $user = DB::table("users")
            ->where("id", $id)
            ->first();
        return is_null($user->email_verified_at);
    }


    /**
     * Search user by the eamil and update the information in the field with the value
     * 
     * @param string $email
     * @param string $field
     * @param string|null $value
     */
    public function updateField(string|int $with, string $field, string|null $value)
    {
        if (is_string($with)) {
            DB::table("users")
                ->where("email", $with)
                ->update([$field => $value]);
        } else {
            DB::table("users")
                ->where("id", $with)
                ->update([$field => $value]);
        }
    }


    /**
     * Hash new password set by user
     * 
     * @param int $email
     * @param string $oldPassword
     * @param string $newPassword
     * 
     * @return string 
     */
    public function hashNewPassword(string $newPassword): string
    {
        return Hash::make($newPassword);
    }


    /**
     * Delete User whose id have been specified from DB
     * 
     * @param int $userId
     */
    public function deleteUser(int $userId)
    {
        DB::table("users")
            ->where("id", $userId)
            ->delete();
    }
}
