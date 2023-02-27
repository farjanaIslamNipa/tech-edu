<?php

namespace App\Http\Requests\PackageSubscriptions;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageSubscriptionStatusRequest extends FormRequest
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
            'subscription_status'   => ['nullable', 'in:0,1,2'],
            'redirect_route'        => ['nullable'],
        ];
    }
}
