<?php

/**
 * Form test
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

use PHPUnit\Framework\TestCase;
use tests\MyForm;

final class FormTest extends TestCase
{
	private $form;

	protected function setUp(): void
	{
		$this->form = new MyForm([
			'first_name' => ' nurasyl ',
			'last_name' => ' ALDAN ',
			'middle_name' => ' ',
			'email' => ' Nurassyl.Aldan@gmail.com ',
			'username' => ' Nurassyl ',
			'password' => ' ',
			'is_admin' => ' true ',
			'birthday' => ' 21.11.1996 ',
			'age' => ' 23 ',
			'created_at' => ' 07.09.2020 00:23:00',
		]);
	}

	public function testFirstName(): void
	{
		$this->assertEquals(
			$this->form->first_name,
			'Nurasyl'
		);
	}

	public function testLastName(): void
	{
		$this->assertEquals(
			$this->form->last_name,
			'Aldan'
		);
	}

	public function testMiddleName(): void
	{
		// because empty string
		$this->assertEquals(
			$this->form->middle_name,
			null
		);
	}

	public function testUsername(): void
	{
		$this->assertEquals(
			$this->form->username,
			'nurassyl'
		);
	}

	public function testEmail(): void
	{
		$this->assertEquals(
			$this->form->email,
			'NURASSYL.ALDAN@GMAIL.COM'
		);
	}

	public function testPassword(): void
	{
		// because no time
		$this->assertEquals(
			$this->form->password,
			' '
		);
	}

	public function testIsAdmin(): void
	{
		$this->assertEquals(
			$this->form->is_admin,
			true
		);
	}

	public function testAge(): void
	{
		$this->assertEquals(
			$this->form->age,
			23
		);
	}

	public function testBoolean(): void
	{
		$form = new MyForm([
			'is_admin' => ' true ',
		]);
		$this->assertEquals(
			$form->is_admin,
			true
		);

		$form = new MyForm([
			'is_admin' => ' on ',
		]);
		$this->assertEquals(
			$form->is_admin,
			true
		);

		$form = new MyForm([
			'is_admin' => ' 1 ',
		]);
		$this->assertEquals(
			$form->is_admin,
			true
		);

		$form = new MyForm([
			'is_admin' => ' yes ',
		]);
		$this->assertEquals(
			$form->is_admin,
			true
		);

		$form = new MyForm([
			'is_admin' => '',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => ' nur ',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([]);
		$this->assertEquals(
			$form->is_admin,
			null,
		);

		$form = new MyForm([
			'is_admin' => ' false ',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => ' no ',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => ' 0 ',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => ' off ',
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => 1,
		]);
		$this->assertEquals(
			$form->is_admin,
			true,
		);

		$form = new MyForm([
			'is_admin' => 0,
		]);
		$this->assertEquals(
			$form->is_admin,
			false,
		);

		$form = new MyForm([
			'is_admin' => 2,
		]);
		$this->assertEquals(
			$form->is_admin,
			true,
		);

		$form = new MyForm([
			'is_admin' => -1,
		]);
		$this->assertEquals(
			$form->is_admin,
			true,
		);

		$form = new MyForm([
			'is_admin' => true,
		]);
		$this->assertEquals(
			$form->is_admin,
			true
		);

		$form = new MyForm([
			'is_admin' => false,
		]);
		$this->assertEquals(
			$form->is_admin,
			false
		);
	}

	public function testInteger()
	{
		$form = new MyForm([
			'age' => null,
		]);
		$this->assertEquals(
			$form->age,
			null
		);

		$form = new MyForm([
			'age' => ' 23 ',
		]);
		$this->assertEquals(
			$form->age,
			23
		);

		$form = new MyForm([
			'age' => 23,
		]);
		$this->assertEquals(
			$form->age,
			23
		);

		$form = new MyForm([
			'age' => true,
		]);
		$this->assertEquals(
			$form->age,
			1
		);

		$form = new MyForm([
			'age' => false,
		]);
		$this->assertEquals(
			$form->age,
			0
		);

		$form = new MyForm([
			'age' => ' ',
		]);
		$this->assertEquals(
			$form->age,
			0
		);

		$form = new MyForm([
			'age' => ' nur ',
		]);
		$this->assertEquals(
			$form->age,
			0
		);

		$form = new MyForm([
			'age' => ' ',
		]);
		$this->assertEquals(
			$form->age,
			null,
		);
	}

	public function testString()
	{
		$form = new MyForm([
			'username' => null,
		]);
		$this->assertEquals(
			$form->username,
			null
		);

		$form = new MyForm([
			'username' => ' ',
		]);
		$this->assertEquals(
			$form->username,
			null
		);

		$form = new MyForm([
			'username' => true,
		]);
		$this->assertEquals(
			$form->username,
			'1'
		);

		$form = new MyForm([
			'username' => false,
		]);
		$this->assertEquals(
			$form->username,
			null
		);
	}

	public function testDate()
	{
		$form = new MyForm([
			'birthday' => '21.11.1996',
		]);

		$this->assertInstanceOf(
			DateTime::class,
			$form->birthday
		);

		$form = new MyForm([
			'birthday' => ' ',
		]);
		$this->assertEquals(
			$form->birthday,
			null,
		);
	}
}

