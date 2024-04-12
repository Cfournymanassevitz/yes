<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user_id = Auth::id();
//    dd($user_id);
        $store = Store::where('user_id', $user_id)->first();
//        dd($store);
        return Auth::check() && $store->user_id === Auth::id();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'theme' => ['string'],
            'biography' => ['string'],

        ];
    }
    public function messages(): array
    {
        return [
            'name.string' => 'The name must be a string',
            'theme.string' => 'The theme must be a string',
            'biography.string' => 'The biography must be a string',
        ];
    }
}
