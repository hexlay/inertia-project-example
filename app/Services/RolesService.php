<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RolesService
{

    public function syncPermissions(array $data, Role $role): void
    {
        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
    }

}
