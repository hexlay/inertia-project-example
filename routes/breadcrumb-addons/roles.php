<?php

use App\Models\Role;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Roles', route('admin.roles.index'));
});

Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Create Role');
});

Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Update Role: ' . $role->name);
});
