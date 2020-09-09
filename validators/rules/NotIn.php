<?php

/**
 * In rule
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace validators\rules;
use validators\Rule;

/**
 * NotIn rule
 */
class NotIn extends Rule
{
	/**
	 * Validate
	 *
	 * @return void
	 */
	public function validate(): void
	{
		if(in_array($this->value, $this->rule, true)) {
			$this->errors[$this->attr][] = 'notIn';
		}
	}
}

