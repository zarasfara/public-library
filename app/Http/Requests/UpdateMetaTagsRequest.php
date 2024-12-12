<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMetaTagsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check() && \Auth::user()->isEmployee();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'keywords' => 'required|string|max:255',
            'robots' => 'required|string|in:index,follow,noindex,nofollow',
        ];
    }

    /**
     * Custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'мета-тег title',
            'description' => 'мета-тег description',
            'keywords' => 'мета-тег keywords',
            'robots' => 'мета-тег robots',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Поле ":attribute" обязательно для заполнения.',
            'title.max' => 'Поле ":attribute" не должно превышать 255 символов.',
            'description.max' => 'Поле ":attribute" не должно превышать 500 символов.',
            'keywords.max' => 'Поле ":attribute" не должно превышать 255 символов.',
            'robots.in' => 'Поле ":attribute" должно содержать одно из значений: index, follow, noindex, nofollow.',
        ];
    }
}
