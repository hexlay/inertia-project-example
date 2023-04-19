<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Traits\ExtendsValidations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileRequest extends FormRequest
{
    use ExtendsValidations;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'avatar' => $this->getRemovableImageValidations($this->avatar),
        ];
    }
}
