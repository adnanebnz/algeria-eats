<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
            'artisan_id' => ['required', 'numeric'],
            'nom' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'categorie' => ['required', 'string'],
            'images' => 'sometimes|array|size:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ];
    }
}
