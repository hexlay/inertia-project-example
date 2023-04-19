<?php

namespace App\Services;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class SettingsService
{

    public static function get(): Collection|Settings|array
    {
        return Settings::with('media')->first();
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public static function save(array $attributes): void
    {
        $settings = self::get();
        $settings->update($attributes);
        $settings->saveMedia($attributes['logo'], 'logo');
    }

}
