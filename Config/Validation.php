<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
		'custom' => 'App\Views\errors\_errors_list'
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
	'name' => 'required|alpha_space',
	'username' => 'required|alpha_numeric|max_length[25]|min_length[7]|is_unique[users.username]',
	'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
	'password' => 'required|min_length[8]',
	'cpassword' => 'required|matches[password]'];
	public $login = [
	'email' => 'required|valid_email|max_length[255]|is_not_unique[users.email]',
	'password' => 'required|min_length[8]'
	];
	public $login_errors = [
	'email' => [
	'is_not_unique' => 'You enter a email is not register on our site. If you have not any account please register on our site'
	]
	];
	public $verifyid = [
	'username' => 'required|max_length[25]|min_length[7]|is_not_unique[users.username]',
	'key' => 'required|numeric|max_length[6]|min_length[6]'
	];
	public $verifyid_errors = [
	'username' => [
	'required' => 'username must be required',
	'is_not_unique' => 'Your username is not stored in database',
	'min_length' => 'username must be 6 charecters long',
	'max_length' => 'username must be 25 charecters or smaller then 25 charecters'
	],
	'key' => [
	'required' => 'Key must be required',
	'max_length' => 'key must be 6 charecters',
	'min_length' => 'Key must be 6 charecters',
	'numeric' => 'Key must be numeric charecters'
	]
	];
	public $password = [
	'password' => 'required|min_length[7]',
	'cpassword' => 'required|matches[password]'
	];
}