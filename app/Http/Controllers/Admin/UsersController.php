<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\Permission\Models\Role;
use function redirect;

class UsersController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::with('roles')
            ->where('name', '!=', 'Admin')
            ->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'columns' => User::$columns,
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::all();

        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles
        ]);
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if (isset($validated['role'])) {
            $user->syncRoles($validated['role']);
        }

        $user->saveMedia('avatar', 'avatar');

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        $roles = Role::all();

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);

        if (isset($validated['role'])) {
            $user->syncRoles($validated['role']);
        }

        $user->saveMedia('avatar', 'avatar');

        return redirect()->route('admin.users.edit', $user)->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
