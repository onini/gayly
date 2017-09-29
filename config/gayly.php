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
	'name'	=>	'Onini Gayly',

	// Panel title
	'title'	=>	'Onini Gayly Panel',

	// Version
	'version'	=>	'beta-0.1',

	// Database setting
	'database'	=>	[
		'prefix'	=>	'oni_',

	],

	// Route config
	'route'	=>	[
		'prefix'	=>	'gayly',
		'namespace'	=>	'App\\Gayly\\Controllers',
		'middleware'	=>	['web', 'gayly'],
		'name'	=>	'gayly.',
	],

	// Install directory
	'directory'	=>	app_path('Gayly'),

	// Https
	'secure'	=>	false,

	// Auth config
	'auth'	=>	[
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
	'upload'	=>	[
		'disk'	=>	'uploads',

		'directory'	=>	[
			'image'	=>	'images',
			'file'	=>	'files',
		],
	],

	// Log setting
	'operation_log'	=>	[
		'enable'	=>	true,

		'except'	=>	[
			'gayly/auth/log*',
		],
	],

	'layout' => 'simple',
];
