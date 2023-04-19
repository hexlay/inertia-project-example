<?php

use App\Models\Settings;
use App\Services\SettingsService;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('settings')) {
    function settings(): Collection|Settings|array
    {
        return SettingsService::get();
    }
}
