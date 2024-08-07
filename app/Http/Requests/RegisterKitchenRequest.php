<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterKitchenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'phone'=>'string|unique:users,phone',
            'email' => 'required|string|unique:users,email|email',
            'password' => 'required|string',
            'kitchen_name'=>'required|string'
        ];
    }
}
