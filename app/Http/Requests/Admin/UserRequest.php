<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Traits\ExtendsValidations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    use ExtendsValidations;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', Password::sometimes(), 'confirmed'],
                'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
                'role' => ['required', 'integer', 'exists:roles,id'],
                'avatar' => $this->getRemovableImageValidations($this->avatar),
            ],
            'PUT', 'PATCH' => [
                'name' => ['required', 'string', 'max:255'],
                'password' => [Password::sometimes(), 'confirmed'],
                'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
                'role' => ['required', 'integer', 'exists:roles,id'],
                'avatar' => $this->getRemovableImageValidations($this->avatar),
            ],
        };
    }
}
