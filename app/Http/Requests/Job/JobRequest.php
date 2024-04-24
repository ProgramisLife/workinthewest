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
            'main_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=600,max_height=600',
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

            'jobstate' => 'required|array',
            'jobstate.*' => [
                'required',
                'distinct',
                'exists:jobstate,id',
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
                'dimensions:min_width=1920,min_height=1080',
                'max:4096'
            ],
            'expiry' => 'date',

            'sex' => ['required', Rule::in(['Mężczyzna', 'Kobieta', 'Inne'])],

            'deadline' => 'date|required',
        ];
    }
}
