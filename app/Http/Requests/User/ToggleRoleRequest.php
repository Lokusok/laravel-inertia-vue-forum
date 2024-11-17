<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ToggleRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', 'exists:roles,id']
        ];
    }
}
