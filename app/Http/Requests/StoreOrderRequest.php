<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
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
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            // Ajoutez d'autres champs si nécessaire
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Le champ product_id est obligatoire.',
            'product_id.integer' => 'Le champ product_id doit être un entier.',
            'product_id.exists' => 'Le produit spécifié n\'existe pas.',
            'quantity.required' => 'Le champ quantity est obligatoire.',
            'quantity.integer' => 'Le champ quantity doit être un entier.',
            'quantity.min' => 'La quantité doit être au moins 1.',
            // Ajoutez d'autres messages d'erreur si nécessaire
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator The validator that failed
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
