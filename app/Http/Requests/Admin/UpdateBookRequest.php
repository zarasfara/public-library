<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

final class UpdateBookRequest extends BaseAdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'available' => 'required|integer',
        ];

        if ($this->hasFile('image')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
