<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateAdminRequest extends FormRequest
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
            'first_name'        => ['required', 'string', 'max:30'],
            'last_name'         => ['nullable', 'string', 'max:30'],
            'email'             => ['required', 'email', 'max:50', Rule::unique(table: 'users', column: 'email')->ignore(id: $this->admin->user, idColumn: 'email')],
            'phone_number'      => ['nullable', 'max:20'],
            'role_id'           => ['required'],
            'redirect_route'    => ['nullable'],
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
