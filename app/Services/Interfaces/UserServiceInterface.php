<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * Create a new user.
     */
    public function create(array $userData): User;
}
