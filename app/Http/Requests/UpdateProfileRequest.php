<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['exclude_if:name,null'],
            'email' => ['exclude_if:email,null', Rule::unique('users')->ignore(Auth::id())],
            'avatar' => ['extensions:jpg,png'],
            'password' => [
                'exclude_if:password,null',
                Password::min(8)
                    ->letters()
                    ->numbers(),
            ],
        ];
    }
}
