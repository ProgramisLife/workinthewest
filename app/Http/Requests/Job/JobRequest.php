<?php

namespace App\Http\Requests\Job;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Job;

class JobRequest extends FormRequest
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

            'salary_from' => 'nullable|integer|min:1|lt:salary_to',
            'salary_to' => 'nullable|integer|gt:salary_from',

            'email' => 'required|email',

            'category' => 'required|exists:jobcategories,id',
            'level' => 'required|exists:joblevels,id',
            'currency' => 'required|exists:currencies,id',

            'type' => 'required',
            'type.*' => [
                'required',
                'distinct',
                'exists:jobtypes,id',
            ],

            'language' => 'nullable|array',
            'language.*' => [
                'nullable',
                'distinct',
                'exists:languages,id',
            ],

            'skill' => 'nullable|array',
            'skill.*' => [
                'nullable',
                'distinct',
                'exists:skills,id',
            ],

            'photos' => 'nullable|array|max:5',
            'photos.*' => [
                'nullable',
                'image',
                'mimes:jpg,png,jpeg,svg',
                'dimensions:min_width=100,min_height=100',
                'max:2048'
            ],
            'expiry' => 'date',

            'sex' => ['required', Rule::in(['Mężczyzna', 'Kobieta', 'Inne'])],

            'deadline' => 'required|date_format:d-m-Y',
        ];
    }
}
