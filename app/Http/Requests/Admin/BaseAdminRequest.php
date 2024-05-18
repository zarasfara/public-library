<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BaseAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::user()->isEmployee();
    }
}
