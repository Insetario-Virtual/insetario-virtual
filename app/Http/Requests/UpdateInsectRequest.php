<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInsectRequest extends FormRequest
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
            'scientific_name' => 'string|max:255',
            'order_id' => 'required|exists:orders,id',
            'family_id' => 'required|exists:families,id',
            'predator' => 'boolean',
            'importance' => 'required|string',
            'morphology' => 'required|string',
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.array' => 'As imagens devem ser enviadas como uma lista de arquivos.',
            'images.*.uploaded' => 'Não foi possível enviar uma das imagens. Verifique se ela possui no máximo 5 MB.',
            'images.*.image' => 'Cada arquivo enviado deve ser uma imagem válida.',
            'images.*.mimes' => 'As imagens devem estar nos formatos JPEG, JPG ou PNG.',
            'images.*.max' => 'Cada imagem deve ter no máximo 5 MB.',
        ];
    }
}
