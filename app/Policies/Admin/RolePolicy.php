<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('read roles');
    }

    public function view(User $user): bool
    {
        return $user->can('read roles');
    }

    public function create(User $user): bool
    {
        return $user->can('create roles');
    }

    public function update(User $user): bool
    {
        return $user->can('update roles');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete roles');
    }
}
