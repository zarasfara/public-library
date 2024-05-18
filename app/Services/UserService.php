<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

final readonly class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Создает нового пользователя на основе предоставленных данных.
     *
     * @param  array  $userData  Данные нового пользователя.
     * @return User Созданный пользователь.
     */
    public function create(array $userData): User
    {
        // we can do in this place some another logic. For example send a letter to email

        return $this->userRepository->create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);
    }
}
