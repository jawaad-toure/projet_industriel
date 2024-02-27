<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class AuthRepository
{

    /**
     * Create one user using username, email and password
     * @param array $signupFormData
     * @return User
     */
    public function addUser(array $signupFormData): User|null
    {
        return null;
    }

    /**
     * Find one user using his email
     *
     * @param string $email
     * @return User|null
     */
    public function getUser(string $email): User|null
    {
        return null;
    }
}