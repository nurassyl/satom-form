<?php

/**
 * In rule's test
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

use PHPUnit\Framework\TestCase;
use validators\rules\In;

class MyForm extends \Form
{
	use \validators\Validator;
	public $email;

	protected function rules(): array
	{
		return [
			'email' => [
				In::rule([
					'nurassyl.aldan@gmail.com',
					'nurassyl.aldan@outlook.com',
				]),
			],
		];
	}
}

final class InTest extends TestCase
{
	public function testRule(): void
	{
		$myform = new MyForm([
			'email' => 'nurassyl.aldan@icloud.com',
		]);
		$this->assertFalse($myform->validate());
		$this->assertContains('in', $myform->getErrors()['email']);

		$myform = new MyForm([
			'email' => 'nurassyl.aldan@gmail.com',
		]);
		$this->assertTrue($myform->validate());
	}
}

