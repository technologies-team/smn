<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitchenRequest extends FormRequest
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
        $rules = [];

        switch ($this->method()) {
            case 'POST': // Store
                $rules = $this->storeRules();
                break;
            case 'PUT': // Update
            case 'PATCH':
                $rules = $this->updateRules();
                break;
            case 'GET': // Show
                $rules = $this->showRules();
                break;
            case 'DELETE': // Delete
                $rules = $this->deleteRules();
                break;
            default:
                break;
        }

        return $rules;
    }

    /**
     * Validation rules for storing a tag.
     *
     * @return array
     */
    protected function storeRules(): array
    {
        return [
            'user.name' => 'string',
            'user.phone'=>'string|unique:users,phone',
            'user.email' => 'string|unique:users,email|email',
            'user.password' => 'string',
            'title'=>'required|string',
            'photo_id'=>'exists:attachments,id',
            'front_id'=>'exists:attachments,id',
            'back_id'=>'exists:attachments,id',
            'cover_id'=>'exists:attachments,id',
        ];
    }

    private function updateRules(): array
    {
        return [
            'photo_id'=>'exists:attachments,id',
            'front_id'=>'exists:attachments,id',
            'back_id'=>'exists:attachments,id',
            'cover_id'=>'exists:attachments,id',
            'user.email' => 'string|unique:users,email|email',


        ];
    }

    private function showRules(): array
    {
        return [

        ];
    }

    private function deleteRules(): array
    {
        return [

        ];
    }
}
