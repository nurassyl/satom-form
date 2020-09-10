<?php

/**
 * Format rule's test
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

use PHPUnit\Framework\TestCase;
use validators\rules\Format;

class FormatForm extends \Form
{
	use \validators\Validator;
	public $username;

	protected function rules(): array
	{
		return [
			'username' => [
				Format::rule('/^[a-z\d_]+$/'),
			],
		];
	}
}

final class FormatTest extends TestCase
{
	public function testRule(): void
	{
		$myform = new FormatForm([
			'username' => 'nurassyl-aldan',
		]);
		$this->assertFalse($myform->validate());
		$this->assertContains('format', $myform->getErrors()['username']);

		$myform = new FormatForm([
			'username' => 'nurassyl21',
		]);
		$this->assertTrue($myform->validate());
	}
}

