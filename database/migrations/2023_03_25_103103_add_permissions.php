<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->getRoles() as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        $adminRole = Role::whereName('Admin')->first();

        foreach ($this->getModules() as $module => $abilities) {
            foreach ($abilities as $ability) {
                $permission = Permission::create([
                    'name' => "$ability $module"
                ]);
                $adminRole->givePermissionTo($permission);
            }
        }
    }

    private function getRoles(): array
    {
        return [
            'User',
            'Admin',
        ];
    }

    private function getModules(): array
    {
        return [
            'users' => [
                'read',
                'update',
                'create',
                'delete',
            ],
            'roles' => [
                'read',
                'update',
                'create',
                'delete',
            ],
            'audits' => [
                'read',
            ],
            'settings' => [
                'read',
                'update',
            ],
        ];
    }
};
