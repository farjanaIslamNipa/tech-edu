<?php

namespace App\Http\Requests\CourseModules;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseModuleRequest extends FormRequest
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
            'code'                      => ['nullable', 'string', 'max:50'],
            'name'                      => ['nullable', 'string', 'max:100'],
            'rating'                    => ['nullable', 'min:1', 'max:5'],
            'short_description'         => ['nullable', 'string', 'max:255'],
            'description'               => ['nullable', 'string'],
            'status'                    => ['nullable', 'in:0,1'],
            'redirect_route'            => ['nullable'],
            'price'                     => ['integer'],
            'payment_link'              => ['nullable', 'string'],
            'training_type'             => ['nullable', 'in:0,1'],
            'course_color_code'         => ['nullable', 'string'],
            'background_color_code'     => ['nullable', 'string'],
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => $this->input('price')* 100,
        ]);
    }
}
