<?php

/**
 * Validator
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace validators;

/**
 * Validator
 */
trait Validator
{
	/**
	 * Rules
	 */
	private $__rules;

	/**
	 * Errors
	 */
	private $__errors = [];

	/**
	 * Validate
	 *
	 * @return boolean
	 */
	public function validate(): bool
	{
		$this->__rules = method_exists($this, 'rules') ? $this->rules() : [];

		foreach($this->getData() as $attr => $val) {
			$rules = $this->__rules[$attr];

			if(is_array($rules)) {
				// $attr has rules

				// required rule
				if(in_array('required', $rules, true) && $val === null) {
					$this->__errors[$attr][] = 'required';
				} else {
					if($val !== null) {
						// min rule
						if(!is_null($rules['min'])) {
							// string type
							if(is_string($val)) {
								if(mb_strlen($val) < $rules['min']) {
									$this->__errors[$attr][] = 'min';
								}
							}
							// integer or float type
							else if(is_integer($val) || is_float($val)) {
								if($val < $rules['min']) {
									$this->__errors[$attr][] = 'min';
								}
							}
							// datetime type
							else if($val instanceof \DateTime) {
								if($val->getTimestamp() < $rules['min']->getTimestamp()) {
									$this->__errors[$attr][] = 'min';
								}
							}
						}
						// max rule
						if(!is_null($rules['max'])) {
							// string type
							if(is_string($val)) {
								if(mb_strlen($val) > $rules['max']) {
									$this->__errors[$attr][] = 'max';
								}
							}
							// integer or float type
							else if(is_integer($val) || is_float($val)) {
								if($val > $rules['max']) {
									$this->__errors[$attr][] = 'max';
								}
							}
							// datetime type
							else if($val instanceof \DateTime) {
								if($val->getTimestamp() > $rules['max']->getTimestamp()) {
									$this->__errors[$attr][] = 'max';
								}
							}
						}

						foreach($rules as $rule) {
							if($rule instanceof Rule) {
								$rule->setAttr($attr)->setValue($val)->setErrors($this->__errors)->validate();
							}
						}
					}
				}
			}
		}

		if(count($this->__errors) === 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Get errors
	 *
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->__errors;
	}
}

