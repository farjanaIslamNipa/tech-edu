<?php

namespace App\Http\Requests\FrequentlyAskedQuestions;

use Illuminate\Foundation\Http\FormRequest;

class IndexFrequentlyAskedQuestionRequest extends FormRequest
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
            'search_query' => ['nullable', 'string'],
            'status'       => ['nullable', 'in:0,1'],
        ];
    }
}
