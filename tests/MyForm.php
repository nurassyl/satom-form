<?php

/**
 * Form test

 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace tests;
use validators\rules\In;

class MyForm extends \Form
{
	use \validators\Validator;

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

	protected function types(): array
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

	protected function rules(): array
	{
		return [
			'username' => [
				'required',
				'min' => 5,
				'max' => 36,
			],
			'age' => [
				'min' => 0,
				'max' => 160,
			],
			'birthday' => [
				'required',
				'min' => new \DateTime('1900-01-01'),
				'max' => new \DateTime('2016-12-31'),
			],
			'email' => [
				'required',
				In::rule([
					'nurassyl.aldan@gmail.com',
					'nurassyl.aldan@outlook.com',
				]),
			],
		];
	}
}

