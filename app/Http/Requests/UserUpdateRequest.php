<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'password'],
            'verified' => ['required'],
            'created_at' => ['required'],
            'last_activity' => ['required'],
            'status' => ['required', 'integer'],
            'photo_profile' => ['nullable', 'string'],
        ];
    }
}
