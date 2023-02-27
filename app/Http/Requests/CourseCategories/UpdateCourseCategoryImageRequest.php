<?php

namespace App\Http\Requests\CourseCategories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseCategoryImageRequest extends FormRequest
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
            'image'          => ['required'],
            'redirect_route' => ['nullable'],
        ];
    }
}