<?php

namespace App\Http\Requests\ManagementAccess;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['super-admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'permission_name' => ['required', 'string'],
            'icon' => ['sometimes', 'required', 'string', 'starts_with:bi-'],
            'status' => ['nullable', 'boolean'],
            'order' => ['nullable', 'numeric'],
            'route' => ['nullable', 'string'],
            'child_menu' => ['nullable', 'boolean'],
        ];
    }
}
