<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;


trait Base64Codable
{
    /**
     * Validate a base64 content.
     */
    public function validateBase64File(string $base64Data, string|array ...$allowedMime): bool
    {
        // strip out data uri scheme information (see RFC 2397)
        if (str_contains(haystack: $base64Data, needle: ';base64')) {
            list($_, $base64Data) = explode(separator: ';', string: $base64Data);
            list($_, $base64Data) = explode(separator: ',', string: $base64Data);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode(string: $base64Data, strict: true) === false) {
            return false;
        }

        // decoding and then recoding should not change the data
        if (base64_encode(string: base64_decode(string: $base64Data)) !== $base64Data) {
            return false;
        }

        $binaryData = base64_decode(string: $base64Data);

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder
        $tmpFile = tempnam(directory: sys_get_temp_dir(), prefix: 'course_module_image');
        file_put_contents(filename: $tmpFile, data: $binaryData);

        return $this->guardAgainstInvalidMimes(file: $tmpFile, allowedMime: $allowedMime);

    }

    /**
     * Guard Against Invalid MimeType
     */
    protected function guardAgainstInvalidMimes(string $file, string|array ...$allowedMime): bool
    {
        // Flatten a multi-dimensional array into a single level.
        $allowedMime = Arr::flatten($allowedMime);

        // no allowedMime, then any type would be ok
        if (empty($allowedMime)) {
            return true;
        }
        // Check the MimeTypes
        $validation = Validator::make(
            ['file' => new File(path: $file)],
            ['file' => 'mimes:' . implode(separator: ',', array: $allowedMime)]
        );

        return !$validation->fails();
    }

    /**
     * Get $base64 encrypted data's file extension
     * @throws Exception
     */
    public static function base64DataFileExtension(string $base64Data): string
    {
        if (str_contains(haystack: $base64Data, needle: ';base64')) {
            list($dataTypeInfo, $_) = explode(separator: ';', string: $base64Data);
            list($_, $fileExtension) = explode('/', $dataTypeInfo);

            return $fileExtension;

        } else {
            throw new Exception(__(key: 'base64.errors.type'));
        }
    }
}
