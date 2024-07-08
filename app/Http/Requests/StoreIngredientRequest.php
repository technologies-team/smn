<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngredientRequest extends FormRequest
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
            'food_id' => 'exists:foods,id',
            'parent_id' => 'exists:ingredients,id'
        ];
    }
    /**
     * Check if the given coordinates fall within the boundaries of Dubai.
     *
     * @return bool
     */

}
