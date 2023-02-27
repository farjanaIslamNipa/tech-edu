<?php

namespace App\Http\Requests\FrequentlyAskedQuestions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFrequentlyAskedQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'question' => ['required', 'string', 'max:191'],
            'answer'   => ['required', 'string', 'max:191'],
            'order'    => ['required', 'integer'],
        ];

    }
}
