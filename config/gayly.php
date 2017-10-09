<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

return [
    // Pacakge name
    'name'    =>    'Onini Gayly',

    // Panel title
    'title'    =>    'Onini Gayly Panel',

    // Version
    'version'    =>    'beta-0.1',

    // Database setting
    'database'    =>    [
        'prefix'    =>    'oni_',

        'users_table'    =>    'system_users',
        'roles_table'    =>    'roles',
        'roles_model'   =>  Onini\Gayly\Models\Role::class,
        'permissions_table'    =>    'permissions',
        'permissions_model' =>  Onini\Gayly\Models\Permission::class,
        'menus_table'    =>    'menus',
        'operation_log_table'    => 'operation_logs',
        'user_permissions_table' => 'user_permissions',
        'role_users_table'       => 'role_users',
        'role_permissions_table' => 'role_permissions',
        'role_menu_table'        => 'role_menus',
    ],

    // Route config
    'route'    =>    [
        'prefix'    =>    'gayly',
        'namespace'    =>    'App\\Gayly\\Controllers',
        'middleware'    =>    ['web', 'gayly'],
        'name'    =>    'gayly.',
    ],

    // Install directory
    'directory'    =>    'Gayly',

    // Https
    'secure'    =>    false,

    // Auth config
    'auth'    =>    [
        'guards' => [
            'gayly' => [
                'driver'   => 'session',
                'provider' => 'gaylies',
            ],
        ],
        'providers' => [
            'gaylies' => [
                'driver' => 'eloquent',
                'model'  => Onini\Gayly\Models\SystemUser::class,
            ],
        ],
    ],

    // Upload config
    'upload'    =>    [
        'disk'    =>    'uploads',

        'directory'    =>    [
            'image'    =>    'images',
            'file'    =>    'files',
        ],
    ],

    // Log setting
    'operation_log'    =>    [
        'enable'    =>    true,

        'except'    =>    [
            'gayly/auth/log*',
        ],
    ],

    'layout' => 'simple',
];
