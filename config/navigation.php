<?php

return [
    'admin_items' => [
        [
            'route' => 'admin.dashboard',
            'label' => 'Dashboard',
        ],
        [
            'route' => 'admin.roles.index',
            'label' => 'Roles',
            'permission' => 'read roles',
        ],
        [
            'route' => 'admin.users.index',
            'label' => 'Users',
            'permission' => 'read users',
        ],
        [
            'route' => 'admin.audits.index',
            'label' => 'Audits',
            'permission' => 'read audits',
        ],
        [
            'route' => 'admin.settings.edit',
            'label' => 'Settings',
            'permission' => 'read settings',
        ],
    ]
];
