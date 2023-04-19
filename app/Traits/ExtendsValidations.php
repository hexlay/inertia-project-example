<?php

namespace App\Traits;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use function is_string;

trait ExtendsValidations
{

    public function getRemovableImageValidations(mixed $value): array
    {
        if (is_string($value)) {
            return ['string'];
        }

        return [
            'nullable',
            File::image()
                ->max(10 * 1024)
                ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(1000))
        ];
    }

}
