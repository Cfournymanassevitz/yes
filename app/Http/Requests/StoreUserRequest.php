<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
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
            'name'=> [ 'required', 'string' ],
            'email'=> [ 'required' , 'string', 'email', 'unique:users' ],
            'password'=> ['required', 'min:8' ]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'email.required' => 'The email field is required',
            'email.email' => 'The email field must be a valid email',
            'email.unique' => 'The email field must be unique',
            'password.required' => 'The password field is required',
            'password.min' => 'The password field must be at least 8 characters'
        ];
    }
}
// To do fonction message erreur (tuto sur le chat
//to do Store Request et Product
