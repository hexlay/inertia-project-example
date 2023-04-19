<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class SettingsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['string', 'max:255'],
            'mail_from' => ['email'],
            'logo' => [
                'nullable',
                File::image()
                    ->max(10 * 1024)
                    ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(1000)),
            ]
        ];
    }
}
