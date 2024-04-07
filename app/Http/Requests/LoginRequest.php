<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Запрос на аутентификацию пользователя.
 *
 * Этот класс представляет собой запрос, отправляемый при попытке аутентификации
 * пользователя в системе. Он определяет правила авторизации и валидации для
 * проверки входных данных, таких как адрес электронной почты и пароль.
 */
final class LoginRequest extends FormRequest
{
    /**
     * Определяет, может ли пользователь делать этот запрос.
     */
    public function authorize(): bool
    {
        return Auth::guest();
    }

    /**
     * Получить правила валидации, применяемые к запросу.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Правила валидации.
     */
    public function rules(): array
    {
        return [
            'email' => ['email', 'required', 'exists:users'],
            'password' => ['required'],
        ];
    }
}
