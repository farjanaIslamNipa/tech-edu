<?php

namespace App\Http\Requests\CourseModules;

use Illuminate\Foundation\Http\FormRequest;

class IndexCourseModuleRequest extends FormRequest
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
            'course_category_id'        => ['nullable', 'exists:course_categories,id'],
            'search_query'              => ['nullable', 'string'],
            'status'                    => ['nullable', 'in:0,1'],
            'training_type'             => ['nullable', 'in:0,1'],
        ];
    }
}
