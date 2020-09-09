<?php

/**
 * Rule
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace validators;

/**
 * Rule interface;
 */
interface iRule {
	/**
	 * Set rule
	 *
	 * @param array|string|integer|float|boolean|null $rule Rule
	 */
	public static function rule($rule = null);

	/**
	 * Set attribute
	 *
	 * @param string $attr Attribute
	 */
	public function setAttr(string $attr);

	/**
	 * Set value
	 *
	 * @param string|integer|float|boolean|null $value Value
	 */
	public function setValue($value);

	/**
	 * Set errors
	 *
	 * @param array $errors Errors
	 */
	public function setErrors(array &$errors);
}

/**
 * Rule class
 */
class Rule implements iRule
{
	/**
	 * Rule
	 */
	protected $rule;

	/**
	 * Attribute
	 */
	protected $attr;

	/**
	 * Value
	 */
	protected $value;

	/**
	 * Errors
	 */
	protected $errors;

	/**
	 * Constructor
	 *
	 * @param array|string|integer|float|boolean|null $rule Rule
	 */
	public function __construct($rule)
	{
		$this->rule = $rule;
	}

	/**
	 * Set rule
	 *
	 * @param array|string|integer|float|boolean|null $rule Rule
	 */
	public static function rule($rule = null)
	{
		return new static($rule);
	}

	/**
	 * Set attribute
	 *
	 * @param string $attr Attribute
	 */
	public function setAttr(string $attr)
	{
		$this->attr = $attr;
		return $this;
	}

	/**
	 * Set value
	 *
	 * @param string|integer|float|boolean|null $value Value
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Set errors
	 *
	 * @param array $errors Errors
	 */
	public function setErrors(array &$errors)
	{
		$this->errors = &$errors;
		return $this;
	}
}

