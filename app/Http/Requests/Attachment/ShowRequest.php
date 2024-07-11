<?php

namespace App\Http\Requests\Attachment;
use Illuminate\Foundation\Http\FormRequest;
class ShowRequest extends FormRequest
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
            'title' => 'string|required',
            'kitchen_id' => 'int|required|exists:kitchen,id',
            'price'=>'int|required'
        ];
    }
}
