<?php

use App\Models\Audit;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.audits.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Audits', route('admin.audits.index'));
});

Breadcrumbs::for('admin.audits.show', function (BreadcrumbTrail $trail, Audit $audit) {
    $trail->parent('admin.audits.index');
    $trail->push('View Audit: #' . $audit->id);
});
