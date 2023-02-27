<?php

namespace App\Http\Requests\CourseModules;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseModuleRequest extends FormRequest
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
            'course_category_id'        => ['required', 'exists:course_categories,id'],
            'code'                      => ['nullable', 'string', 'max:255'],
            'name'                      => ['required', 'string', 'max:100'],
            'rating'                    => ['required', 'min:1', 'max:5'],
            'short_description'         => ['nullable', 'string', 'max:255'],
            'description'               => ['nullable', 'string'],
            'status'                    => ['required', 'in:0,1'],
            'training_type'             => ['required', 'in:0,1'],
            'price'                     => ['required', 'integer'],
            'payment_link'              => ['nullable', 'string'],
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
