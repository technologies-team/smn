<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitchenSettingRequest extends FormRequest
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
            'kitchen_id'=>'exists:kitchens,id',
            'delivery_type'=>'nullable|string',
            'social.facebook'=>'nullable|string',
            'social.website'=>'nullable|string',
            'social.phone'=>'nullable|string',
            'social.tiktok'=>'nullable|string',
            'social.snap'=>'nullable|string',
            'social.instagram'=>'nullable|string',
            'social.x'=>'nullable|string',
            'availability.*.start_time' => 'nullable|date_format:H:i',
            'availability.*.end_time' => 'nullable|date_format:H:i|after:availability.*.start_time',
        ];
    }

    private function updateRules(): array
    {
        return [

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
