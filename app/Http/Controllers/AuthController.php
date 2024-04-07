<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\StoreAvatarAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function signIn(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return to_route('dashboard')->with('success', __('messages.success_login'));
        } else {
            return back()->withErrors([
                'error' => __('messages.incorrect_credentials'),
            ]);
        }
    }

    public function signUp(RegisterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = $this->userService->create($credentials);
        $user->toArray();

        Auth::login($user);

        return to_route('dashboard');
    }

    public function updateProfile(UpdateProfileRequest $request, StoreAvatarAction $storeAvatarAction): RedirectResponse
    {
        $data = $request->validated();

        if ($request->has('avatar')) {
            $data['avatar'] = $storeAvatarAction($request->file('avatar'), 'avatars');
        }

        /** @var User $user */
        $user = Auth::user();

        $user->update($data);

        return redirect()->back();
    }
}
