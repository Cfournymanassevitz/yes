<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'=> [ 'required', 'string' , 'max:255'],
            'description'=> [ 'required', 'string'],
            'price'=> [ 'required', 'numeric'],
        ];

    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'name.string' => 'The name field must be a string',
            'name.max' => 'The name field must be less than 255 characters',
            'description.required' => 'The description field is required',
            'description.string' => 'The description field must be a string',
            'price.required' => 'The price field is required',
            'price.numeric' => 'The price field must be a number',
            ];
    }
}
