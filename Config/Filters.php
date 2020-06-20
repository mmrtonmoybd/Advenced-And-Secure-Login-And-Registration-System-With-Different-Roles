<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'maintenance' => \App\Filters\Maintenance::class,
		'throttle' => \App\Filters\Throttle::class,
		'ban' => \App\Filters\Ban::class,
		'isLogin' => \App\Filters\Auth::class,
		'nonauth' => \App\Filters\Nonauth::class,
		'isAdmin' => \App\Filters\Admin::class,
		'isEditor' => \App\Filters\Editor::class,
		'isAuthor' => \App\Filters\Author::class,
		'isContributor' => \App\Filters\Contributor::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			//'csrf',
			//'throttle',
			/*'maintenance' => [
			'except' => 'maintenance'
			],*/
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [
	//'post' => ['throttle']
	];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [
	'ban' => [ 
	'before' => [
	'login', 
	'register',
	'forget/password',
	'forget/password/*',
	'verify/id/*'
	]
	],
	'isLogin' => [
	'before' => [
	'users/dashboard',
	'logout'
	]
	],
	'nonauth' => [
	'before' => [
	'login',
	'register',
	'forget/password',
	'forget/password/*',
	'verify/id/*'
	]
	],
	'isAdmin' => [
	/*'before' => [
  //url
	]*/
	],
	'isEditor' => [
 /*'before' => [
	//url
	]*/
	],
	'isAuthor' => [
	/*'before' => [
	//url
	]*/
	],
	'isContributor' => [
	/*'before' => [
	//url
	]*/
	]
	
	];
}