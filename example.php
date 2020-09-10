<?php

/**
 * Example
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */


require_once __DIR__ . '/boot.php';
use validators\Validator;
use validators\rules\In;
use validators\rules\Format;


class MyForm extends Form
{
	use Validator;

	public $name;
	public $birthday;
	public $gender;
	public $username;
	public $password;
	public $is_admin;

	/**
	 * Types: string/str, integer/int, float, boolean/bool, date/datetime/time
	 */
	protected function types(): array
	{
		return [
			'birthday' => 'date', # default 'string',
			'is_admin' => 'boolean',
		];
	}

	/**
	 * Normalizers: trim, lowercase, uppercase, capitalize
	 */
	protected function normalize(): array
	{
		return [
			'name' => [
				'trim',
				'capitalize',
			],
			'username' => [
				'trim',
				'lowercase',
			],
		];
	}

	protected function rules(): array
	{
		return [
			'name' => [
				'required',
				'max' => 15,
				Format::rule('/^[а-яa-z]+$/ui'),
			],
			'birthday' => [
				'min' => new DateTime('1900-01-01'),
				'max' => new DateTime('2016-12-31'),
			],
			'gender' => [
				In::rule([
					'male',
					'female',
				]),
			],
			'username' => [
				'required',
				'min' => 5,
				'max' => 36,
				Format::rule('/^[a-z\d_]+$/i'),
			],
		];
	}
}

$data = [
	'name' => 'Nurasyl',
	'birthday' => '21.11.1996',
	'gender' => 'male',
	'username' => 'nurassyl',
	'password' => '1234567890',
	'is_admin' => '1',
];

$myform = new MyForm($data);

if($myform->validate()) {
	echo 'Name: ' . $myform->name . PHP_EOL;
	echo 'Username: ' . $myform->username . PHP_EOL;
} else {
	print_r($myform->getErrors());
}

