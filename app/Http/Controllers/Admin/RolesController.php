<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Services\RolesService;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use function in_array;
use function redirect;

class RolesController extends Controller
{

    public function __construct(
        protected RolesService $rolesService
    )
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::with('permissions')->get();

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'columns' => Role::$columns
        ]);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $validated = $request->validated();

        $role = Role::create($validated);

        $this->rolesService->syncPermissions($validated, $role);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }

    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();

        return Inertia::render('Admin/Roles/Create', [
            'permissions' => $permissions,
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);

        if (in_array($role->name, Role::BASE_ROLES)) {
            return redirect()->route('admin.roles.index')->with('error', 'Unable to update base roles');
        }

        $role->load('permissions');

        $permissions = Permission::all();

        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', Role::class);

        if (in_array($role->name, Role::BASE_ROLES)) {
            return redirect()->route('admin.roles.index')->with('error', 'Unable to update base roles');
        }

        $validated = $request->validated();

        $role->update($validated);

        $this->rolesService->syncPermissions($validated, $role);

        return redirect()->route('admin.roles.edit', $role)->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        if (in_array($role->name, Role::BASE_ROLES)) {
            return redirect()->route('admin.roles.index')->with('error', 'Unable to delete base roles');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
