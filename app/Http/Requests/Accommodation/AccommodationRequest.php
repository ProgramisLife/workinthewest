<?php

namespace App\Http\Requests\Accommodation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccommodationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'main_image_path' => 'nullable|image|mimes:jpeg,png|max:1',
            'description'   => 'required|string|min:5',
            'contact' => 'required|string|min:5',
            'phone_number' => 'nullable|integer|min:9',

            'price_buy' => 'nullable|integer|min:1|max:2147483647',
            'price_rent' => 'nullable|integer|min:1|max:2147483647',

            'currency' => 'required|exists:currencies,id',

            'photos' => 'nullable|array|max:5',
            'photos.*' => [
                'nullable',
                'image',
                'mimes:jpg,png,jpeg,svg',
                'dimensions:min_width=100,min_height=100',
                'max:2048'
            ],
            'expiry' => 'date',
        ];
    }
}
