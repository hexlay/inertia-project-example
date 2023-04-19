<?php

use App\Http\Controllers\Admin\AuditsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('admin')->as('admin.')->group(function () {
        // Profile
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'edit')->name('profile.edit');
            Route::patch('/profile', 'update')->name('profile.update');
        });

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Roles
        Route::resource('/roles', RolesController::class)->except('show');

        // Users
        Route::resource('/users', UsersController::class)->except('show');

        // Settings
        Route::controller(SettingsController::class)->group(function () {
            Route::get('/settings', 'edit')->name('settings.edit');
            Route::patch('/settings', 'update')->name('settings.update');
        });

        // Audits
        Route::resource('/audits', AuditsController::class)->only('index', 'show');
    });
});

// Addons
foreach (glob(__DIR__ . '/router-addons/*.php') as $path) {
    require $path;
}
