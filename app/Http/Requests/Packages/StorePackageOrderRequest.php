<?php

namespace App\Http\Requests\Packages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class StorePackageOrderRequest extends FormRequest
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
            'package_id'                => ['required', 'exists:packages,id'],
            'package_type_id'           => ['required', 'exists:package_types,id'],

            'course_module_id'          => ['required','array'],
            'course_module_id.*'        => ['exists:course_modules,id'],

            'first_name'                => ['required', 'string'],
            'last_name'                 => ['nullable', 'string'],
            'phone_number'              => ['required', 'string'],
            'email'                     => ['required', 'string', 'email'],
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
