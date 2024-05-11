<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

final class DeleteAuthorRequest extends BaseAdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author_id' => 'integer|required|exists:authors,id',
        ];
    }
}
