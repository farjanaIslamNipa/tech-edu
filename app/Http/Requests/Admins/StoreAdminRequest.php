<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'phone_number'  => ['required', 'max::20'],
            'role_id'       => ['required', 'exists:roles,id'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'role_id' => 'role',
        ];
    }
}
