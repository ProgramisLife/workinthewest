<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'main_image_path' => 'nullable|image|mimes:jpeg,png|max:1',
            'description'   => 'required|string|min:5',

            'source' => 'nullable|url',
            'youtube' => 'nullable|url',
            'facebook' => 'nullable|url',
            'vimeo' => 'nullable|url',
            'x' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ];
    }
}
