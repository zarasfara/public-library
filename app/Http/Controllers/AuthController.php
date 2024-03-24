<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function signIn(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return to_route('dashboard')->with('success', 'Вы успешно вошли в систему.');
        } else {
            return back()->withErrors([
                'password' => 'Неверный адрес электронной почты или пароль.'
            ]);
        }
    }

    public function signUp(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validated();

        $user = $this->userService->create($credentials);

        Auth::login($user);

        return to_route('dashboard');
    }
}
