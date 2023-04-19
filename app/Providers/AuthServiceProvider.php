<?php

namespace App\Providers;

use App\Models\Audit;
use App\Models\Settings;
use App\Models\User;
use App\Models\Role;
use App\Policies\Admin\AuditPolicy;
use App\Policies\Admin\RolePolicy;
use App\Policies\Admin\SettingsPolicy;
use App\Policies\Admin\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Settings::class => SettingsPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Audit::class => AuditPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
