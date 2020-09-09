<?php

/**
 * NotIn rule's test
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

use PHPUnit\Framework\TestCase;
use validators\rules\NotIn;

class NotInForm extends \Form
{
	use \validators\Validator;
	public $email;

	protected function rules(): array
	{
		return [
			'email' => [
				NotIn::rule([
					'nurassyl.aldan@gmail.com',
					'nurassyl.aldan@outlook.com',
				]),
			],
		];
	}
}

final class NotInTest extends TestCase
{
	public function testRule(): void
	{
		$myform = new NotInForm([
			'email' => 'nurassyl.aldan@gmail.com',
		]);
		$this->assertFalse($myform->validate());
		$this->assertContains('notIn', $myform->getErrors()['email']);
	}
}

