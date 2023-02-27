<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'first_name'    => ['required', 'string', 'max:30'],
            'last_name'     => ['nullable', 'string', 'max:30'],
            'email'         => ['required', 'email', 'unique:users,email', 'max:30'],
            'phone_number'  => ['required', 'max:20'],

            'street'        => ['required', 'max:191', 'string'],
            'suburb'        => ['required', 'max:50', 'string'],
            'state'         => ['required', 'max:30', 'string'],
            'post_code'     => ['required', 'max:10', 'string'],
            'country'       => ['required', 'max:50', 'string'],
        ];
    }
}
