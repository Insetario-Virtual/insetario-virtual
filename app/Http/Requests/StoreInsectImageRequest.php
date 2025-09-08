<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsectImageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Main insect data
            'scientific_name' => ['required', 'string', 'max:255', 'unique:insects,scientific_name'],
            'id_order'        => ['required', 'exists:orders,id'],
            'id_family'       => ['required', 'exists:families,id'],
            'predator'        => ['required', 'boolean'],
            'importance'      => ['nullable', 'string', 'max:2000'],
            'morphology'      => ['nullable', 'string', 'max:2000'],

            // Common names
            'common_names'    => ['nullable', 'array'],
            'common_names.*'  => ['required_with:common_names', 'string', 'max:255'],

            // Cultures (IDs)
            'cultures'        => ['nullable', 'array'],
            'cultures.*'      => ['integer', 'exists:cultures,id'],

            // Images
            'images'          => ['nullable', 'array'],
            'images.*'        => ['image', 'mimes:jpeg,png,jpg', 'max:2048'], // 2MB max per file
        ];
    }
}
