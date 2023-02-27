<?php

namespace App\Http\Requests\PackageSubscriptions;

use Illuminate\Foundation\Http\FormRequest;

class IndexPackageSubscriptionRequest extends FormRequest
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
            'search_query'          => ['nullable', 'string'],
            'client_id'             => ['nullable', 'exists:clients,id'],
            'payment_status'        => ['nullable', 'in:0,1'],
            'subscription_status'   => ['nullable', 'in:0,1,2'],
        ];
    }
}
