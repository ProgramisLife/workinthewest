<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'companyname' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
            'statute' => 'accepted'
        ];
    }
}
