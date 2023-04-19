<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Models\Settings;
use App\Services\SettingsService;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use function redirect;

class SettingsController extends Controller
{

    public function edit()
    {
        $this->authorize('update', Settings::class);

        return Inertia::render('Admin/Settings/Edit', [
            'settings' => settings()
        ]);
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function update(SettingsRequest $request)
    {
        $this->authorize('update', Settings::class);

        SettingsService::save($request->validated());

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully');
    }
}
