<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'section_id' => ['nullable', 'integer', 'exists:sections,id'],
            'branch_id' => ['nullable', 'integer', 'exists:branches,id']
        ];
    }
}
