<?php

/**
 * Format rule
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace validators\rules;
use validators\Rule;

/**
 * Format rule
 */
class Format extends Rule
{
	/**
	 * Validate
	 *
	 * @return void
	 */
	public function validate(): void
	{
		if(!preg_match($this->rule, $this->value)) {
			$this->errors[$this->attr][] = 'format';
		}
	}
}

