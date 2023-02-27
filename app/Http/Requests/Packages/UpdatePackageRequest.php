<?php

namespace App\Http\Requests\Packages;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'redirect_route'                        => ['nullable'],

            'name'                                  => ['required', 'max: 100'],
            'short_description'                     => ['nullable', 'string', 'max:255'],
            'description'                           => ['nullable', 'string'],
            'status'                                => ['required', 'in:0,1'],

            'package_type'                          => ['nullable', 'array'],
            'package_type.*.type'                   => ['required'],
            'package_type.*.discount_percentage'    => ['nullable'],
            'package_type.*.minimum_course_count'   => ['required'],
            'package_type.*.payment_link'           => ['nullable'],
            'package_type.*.status'                 => ['required', 'in:0,1'],

            'course_module_id'                      => ['required','array'],
            'course_module_id.*'                    => ['exists:course_modules,id'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     */
    public function attributes()
    {
        return [
            'package_type.*.type'                   => 'type',
            'package_type.*.discount_percentage'    => 'discount percentage',
            'package_type.*.minimum_course_count'   => 'minimum course count',
            'package_type.*.status'                 => 'status',

            'course_module_id'                      => 'course',


        ];
    }
}
