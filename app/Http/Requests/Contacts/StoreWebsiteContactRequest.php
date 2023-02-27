<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

/**
 * @property mixed $g-recaptcha-response
 */
class StoreWebsiteContactRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name'        => ['required', 'string', 'max:30'],
            'last_name'         => ['nullable', 'string', 'max:30'],
            'email'             => ['required', 'email', 'max:50'],
            'phone_number'      => ['required', 'max:20'],
            'subject'           => ['required', 'string', 'max:191'],
            'message'           => ['required', 'string'],
            'agree_with_tnc'    => ['required', 'in:1'],
            'redirect_route'    => ['nullable']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'agree_with_tnc' => 'TnC and PP',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'agree_with_tnc.required' => 'Must have to agree on the TnC and PP',
            'body.required' => 'A message is required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->googleRecaptchaValidation()) {
                $validator->errors()->add('robot_detected', 'Caution! The system has identified you as a robot.');
            }
        });

    }

    protected function googleRecaptchaValidation(): bool
    {
        $response = HTTP::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('google_recaptcha.secret_key'),
            'response' => $this->input('g-recaptcha-response'),
        ]);

        $response = json_decode($response);

        if ($response?->success == false) {
            return false;
        }

        if (!(App::environment('local')) && !($response?->hostname == config('google_recaptcha.host'))) {
            return false;
        }

        return true;
    }
}
