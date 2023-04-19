<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('read users');
    }

    public function view(User $user): bool
    {
        return $user->can('read users');
    }

    public function create(User $user): bool
    {
        return $user->can('create users');
    }

    public function update(User $user): bool
    {
        return $user->can('update users');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete users');
    }
}
