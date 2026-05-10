<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            
            // New validation rules for BiyaheMMSU roles and categories
            'role' => ['required', 'string', 'in:student,driver,admin'], 
            'category' => ['required', 'string', 'in:student,senior,pwd,regular'],
            
            // license_no is only required if the user is a driver
            'license_no' => ['required_if:role,driver', 'nullable', 'string', 'max:255'],
        ];
    }
}