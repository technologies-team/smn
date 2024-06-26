<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'offset' => 'numeric',
            'limit' => 'numeric',
            'keyword' => 'string',
            'sort' => 'nullable',
            'sort.column' => 'required|string',
            'sort.order' => 'required|string',
            'fields.*.value' => 'required',
        ];
    }
}
