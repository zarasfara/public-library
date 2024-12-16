<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreAvatarAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Контроллер аутентификации и управления профилем пользователя.
 *
 * Этот контроллер обеспечивает обработку запросов, связанных с аутентификацией
 * пользователей (вход в систему, выход из системы) и управлением профилем пользователя
 * (регистрация, обновление профиля).
 */
final class AuthController extends Controller
{
    /**
     * Создает новый экземпляр контроллера.
     *
     * @param  UserServiceInterface  $userService  Сервис пользователя для выполнения операций с пользователями.
     */
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    /**
     * Обрабатывает запрос на вход в систему.
     *
     * @param  LoginRequest  $request  Запрос на вход в систему.
     * @return RedirectResponse Редирект после входа в систему.
     */
    public function signIn(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'))->with('success', __('messages.success_login'));
        } else {
            return back()->withErrors([
                'error' => __('messages.incorrect_credentials'),
            ]);
        }
    }

    /**
     * Обрабатывает запрос на регистрацию нового пользователя.
     *
     * @param  RegisterRequest  $request  Запрос на регистрацию нового пользователя.
     * @return RedirectResponse Редирект после регистрации пользователя.
     */
    public function signUp(RegisterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = $this->userService->create($credentials);

        Auth::login($user);

        return to_route('dashboard');
    }

    /**
     * Обрабатывает запрос на обновление профиля пользователя.
     *
     * @param  UpdateProfileRequest  $request  Запрос на обновление профиля пользователя.
     * @param  StoreAvatarAction  $storeAvatarAction  Действие для сохранения аватара пользователя.
     * @return RedirectResponse Редирект после обновления профиля пользователя.
     */
    public function updateProfile(UpdateProfileRequest $request, StoreAvatarAction $storeAvatarAction): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $avatarPath = $storeAvatarAction($request->file('avatar'), 'avatars');
            if (! is_null($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $avatarPath;
            $user->avatar = $avatarPath;
        }

        if ($user->update($data)) {
            return redirect()->back()->with('success', __('messages.profile_updated'));
        } else {
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }

    /**
     * Обрабатывает запрос на логаут.
     */
    public function signOut(): RedirectResponse
    {
        Auth::logout();

        return to_route('login.form');
    }
}
