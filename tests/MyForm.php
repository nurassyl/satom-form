<?php

/**
 * Form test

 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace tests;

use forms\Form;

class MyForm extends Form
{
	public $first_name;
	public $last_name;
	public $middle_name;
	public $birthday;
	public $gender;
	public $age;
	public $username;
	public $email;
	public $password;
	public $is_admin;
	public $created_at;

	protected function type(): array
	{
		return [
			'username' => 'string',
			'birthday' => 'date',
			'age' => 'int',
			'is_admin' => 'bool',
			'birthday' => 'date',
			'created_at' => 'datetime',
		];
	}

	protected function normalize(): array
	{
		return [
			'first_name' => [
				'trim',
				'capitalize',
			],
			'last_name' => [
				'trim',
				'capitalize',
			],
			'middle_name' => [
				'trim',
				'capitalize',
			],
			'gender' => ['trim'],
			'username' => [
				'trim',
				'lowercase',
			],
			'email' => [
				'trim',
				'uppercase',
			],
		];
	}
}

