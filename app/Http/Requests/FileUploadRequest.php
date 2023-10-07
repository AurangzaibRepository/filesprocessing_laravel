<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class FileUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'input-file' => [
                'required',
                File::types(['csv']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'File is required',
        ];
    }
}
