<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
            'name'              => ['required','max:255', Rule::unique(table: 'roles', column: 'name')->ignore($this->name, idColumn: 'name')],
            'permission'        => ['required'],
            'redirect_route'    => ['nullable'],
        ];
    }
}
