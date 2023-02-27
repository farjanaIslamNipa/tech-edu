<?php

namespace App\Rules;

use App\Traits\Base64Codable;
use Illuminate\Contracts\Validation\Rule;

class Base64Image implements Rule
{
    use Base64Codable;

    /**
     * Create a new rule instance.
     *
     * @param string|array $allowedMime
     * @return void
     */
    public function __construct(protected string|array $allowedMime = []) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->validateBase64File(base64Data: $value, allowedMime: $this->allowedMime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        if (!$this->allowedMime) {
            return trans(key: 'validation.custom.base64Image.image');
        } else {
            return trans(key: 'validation.custom.base64Image.image_with_mimes', replace: ['values' => implode(separator: ', ', array: $this->allowedMime)]);
        }
    }
}
