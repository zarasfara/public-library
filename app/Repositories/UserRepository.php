<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * Создает нового пользователя на основе предоставленных данных.
     *
     * @param  array  $data  Данные нового пользователя.
     * @return User Созданный пользователь.
     */
    public function create(array $data): User
    {
        return User::create($data);
    }
}
