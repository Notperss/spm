<?php

namespace App\Http\Requests\Location;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'order' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'direction' => 'nullable|string|max:255',
            'segment' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'hm1' => 'nullable|numeric|max:255',
            'hm2' => 'nullable|numeric|max:255',
            'km1' => 'nullable|numeric|max:255',
            'km2' => 'nullable|numeric|max:255',
        ];
    }
}
