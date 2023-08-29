<?php

use App\Enums\PermissionEnums;

return [
    [
        'href' => 'dashboard',
        'text' => '',
        'is_multi' => false,
        'icon' => 'fas fa-chart-bar',
    ],
    [
        'href' => [
            [
                'href' => 'roles.index',
                'text' => 'menu.role.index',
                'icon' => 'fa fa-users',
                'permission' => 'role' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION
            ],
            [
                'href' => 'users.index',
                'text' => 'menu.user.index',
                'icon' => 'fa fa-user',
                'permission' => 'user' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION
            ],
            [
                'href' => 'admins.index',
                'text' => 'menu.admins.index',
                'icon' => 'fa fa-user',
                'permission' => 'admin' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION
            ],
            [
                'href' => 'blogs.index',
                'text' => 'menu.blogs.index',
                'icon' => 'fa fa-book',
                'permission' => 'blog' . PermissionEnums::HYPHEN . PermissionEnums::READ_ACTION
            ],
        ],
        'text' => '',
        'is_multi' => true,
    ],
];
