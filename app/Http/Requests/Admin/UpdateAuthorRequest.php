<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

final class UpdateAuthorRequest extends BaseAdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'patronymic' => 'nullable|string',
        ];
    }
}
