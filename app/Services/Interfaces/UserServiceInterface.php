<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * Create a new user.
     *
     * @param array $userData
     * @return User
     */
    public function create(array $userData): User;
}
