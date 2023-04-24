<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Role extends \Spatie\Permission\Models\Role
{

    const BASE_ROLES = [
        'Admin',
        'User',
    ];

    public static $columns = [
        'name' => 'Role name',
    ];

    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->where('name', '!=', 'Admin');
    }

}
