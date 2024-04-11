<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'address'=> [ 'required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'name.string' => 'The name field must be a string',
            'name.max' => 'The name field must be less than 255 characters',
            'address.required' => 'The address field is required',
            'address.string' => 'The address field must be a string',

            ];
    }
}
