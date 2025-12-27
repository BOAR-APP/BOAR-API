<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'location' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'latitude' => ['required', 'numeric', 'between:-180,180'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'logo' => ['nullable', 'string'],
            'mail' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'integer'],
        ];
    }
}
