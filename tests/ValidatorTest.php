<?php

/**
 * Validator test
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

use PHPUnit\Framework\TestCase;
use tests\MyForm;

final class ValidatorTest extends TestCase
{
	public function testRequired()
	{
		$form = new MyForm([
			'username' => ' ',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('required', $form->getErrors()['username']),
			true
		);

		$form = new MyForm([

		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('required', $form->getErrors()['username']),
			true
		);
	}

	public function testMin()
	{
		$form = new MyForm([
			'username' => 'nur',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('min', $form->getErrors()['username']),
			true
		);

		$form = new MyForm([
			'age' => '-1',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('min', $form->getErrors()['age']),
			true
		);

		$form = new MyForm([
			'birthday' => '1899-12-21 23:59:59',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('min', $form->getErrors()['birthday']),
			true
		);
	}

	public function testMax()
	{
		$form = new MyForm([
			'username' => 'nurassyl is my username nurassyl is my username',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('max', $form->getErrors()['username']),
			true
		);

		$form = new MyForm([
			'age' => '161',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('max', $form->getErrors()['age']),
			true
		);

		$form = new MyForm([
			'birthday' => '2017-01-01',
		]);
		$this->assertEquals(
			$form->validate(),
			false
		);
		$this->assertEquals(
			in_array('max', $form->getErrors()['birthday']),
			true
		);
	}
}

