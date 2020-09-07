<?php

/**
 * Validator
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace validators;

/**
 * Primary validator
 */
trait Primary
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
			if(is_array($this->__rules[$attr])) {
				// $attr has rules

				// required rule
				if(array_key_exists('required', $this->__rules[$attr]) && $this->__rules[$attr]['required'] == true && $val === null) {
					$this->__errors[$attr][] = 'required';
				} else {
					if($val !== null) {
						// min rule
						if(!is_null($this->__rules[$attr]['min'])) {
							// string type
							if(is_string($val)) {
								if(mb_strlen($val) < $this->__rules[$attr]['min']) {
									$this->__errors[$attr][] = 'min';
								}
							}
							// integer or float type
							else if(is_integer($val) || is_float($val)) {
								if($val < $this->__rules[$attr]['min']) {
									$this->__errors[$attr][] = 'min';
								}
							}
							// datetime type
							else if($val instanceof \DateTime) {
								if($val->getTimestamp() < $this->__rules[$attr]['min']->getTimestamp()) {
									$this->__errors[$attr][] = 'min';
								}
							}
						}
						// max rule
						if(!is_null($this->__rules[$attr]['max'])) {
							// string type
							if(is_string($val)) {
								if(mb_strlen($val) > $this->__rules[$attr]['max']) {
									$this->__errors[$attr][] = 'max';
								}
							}
							// integer or float type
							else if(is_integer($val) || is_float($val)) {
								if($val > $this->__rules[$attr]['max']) {
									$this->__errors[$attr][] = 'max';
								}
							}
							// datetime type
							else if($val instanceof \DateTime) {
								if($val->getTimestamp() > $this->__rules[$attr]['max']->getTimestamp()) {
									$this->__errors[$attr][] = 'max';
								}
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

