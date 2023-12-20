<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact_no' => ['required', 'string', 'max:20'],
            'default_address_id' => ['nullable', 'exists:addresses,id'],

            'current_password' => ['required_with:password', 'nullable', ' min:8', ' max:255'],
            'password' => ['nullable', 'required_with:current_password', ' min:8', ' max:255', 'confirmed'],
        ];
    }
}
