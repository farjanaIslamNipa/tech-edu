<?php

namespace App\Http\Requests\CourseCategories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseCategoryRequest extends FormRequest
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
            'name'                  => ['nullable', 'string', 'max:100'],
            'short_description'     => ['nullable', 'string', 'max:255'],
            'status'                => ['nullable', 'in:0,1'],
            'redirect_route'        => ['nullable'],
            'is_primary'            => ['nullable', 'in:0,1'],
            'course_color_code'     => ['nullable', 'string'],
            'background_color_code' => ['nullable', 'string'],
        ];
    }
}
