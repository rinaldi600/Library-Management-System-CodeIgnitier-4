<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
        'dashboardAdminAuth' => \App\Filters\DashboardAdminAuth::class,
        'dashboardUserAuth' => \App\Filters\DashboardUserAuth::class
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			 'csrf' => [
			     'except' => [
			         'admin',
                     'admin/*',
                     'user',
                     'user/*',
                     '/',
                     'dashboardAdmin/logoutAdmin',
                     'dashboardAdmin/insertNewBook',
                     'dashboardAdmin/editOldBook',
                     'dashboardAdmin/deleteBook',
                     'dashboardAdmin/getIdBookAjax',
                     'dashboardUser/rentBook',
                     'dashboardUser/cancelRentBook',
                     'dashboardUser/getIDUserAjax',
                     'dashboardUser/getIDBookAjax',
                     'dashboardAdmin/deleteUser',
                     'dashboardAdmin/getIDUserAjax',
                     'dashboardAdmin/deleteRequest',
                     'dashboardAdmin/acceptRequest',
                     'dashboardAdmin/cancelAcceptRequest',
                     'dashboardAdmin/declineUser',
                     'dashboardUser/logoutUser',
                     'dashboardUser/returnBook',
                     'dashboardUser/retryRequestBook',
                     'idAdmin/getData'
                 ]
             ]
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [
	    'dashboardAdminAuth' => [
	        'before' => [
	            'dashboardAdmin',
                'dashboardAdmin/*'
            ]
        ],
        'dashboardUserAuth' => [
            'before' => [
                'dashboardUser',
                'dashboardUser/*'
            ]
        ],
    ];
}
