<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|required_without_all:phone,remember_token|string',
            'password' => 'sometimes|required_without_all:phone,remember_token|string',
            'phone' => 'sometimes|required_without_all:email,password|string',
            'remember_token' => 'sometimes|required_without_all:name,phone|string',
        ];
    }
}
