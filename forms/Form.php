<?php

/**
 * Form
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */

namespace forms;

/**
 * Form
 */
abstract class Form
{
	/**
	 * Type
	 *
	 * @var array $type
	 */
	private $type;

	/**
	 * Normalize
	 *
	 * @var array $normalize
	 */
	private $normalize;

	/**
	 * Data
	 *
	 * @var array $data
	 */
	private $data;

	/**
	 * Constructor
	 *
	 * @param array $data Data
	 */
	public function __construct(array $data)
	{
		$this->data = $data;
		$this->construct($this->data);
	}

	/**
	 * Set types and normalize input data.
	 *
	 * @param array $data Data
	 *
	 * @return void
	 */
	private function construct(array $data): void
	{
		$this->type = method_exists($this, 'type') ? $this->type() : [];
		$this->normalize = method_exists($this, 'normalize') ? $this->normalize() : [];

		foreach(array_keys(get_object_vars($this)) as $attr) {
			if(isset($data[$attr]) && !is_null($data[$attr])) {
				// set value
				$this->$attr = $data[$attr];

				// set type
				if($this->type[$attr] === 'string' || $this->type[$attr] === 'str') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					} else {
						$this->$attr = (string) $this->$attr;
					}
				} else if($this->type[$attr] === 'integer' || $this->type[$attr] === 'int') {
					$this->$attr = (int) $this->$attr;
				} else if($this->type[$attr] === 'float' || $this->type[$attr] === 'double' || $this->type[$attr] === 'real') {
					$this->$attr = (float) $this->$attr;
				} else if($this->type[$attr] === 'boolean' || $this->type[$attr] === 'bool') {
					if(is_string($this->$attr)) {
						$this->$attr = trim($this->$attr);
						if($this->$attr === 'true' || $this->$attr === '1' || $this->$attr === 'on' || $this->$attr === 'yes') {
							$this->$attr = true;
						} else {
							$this->$attr = false;
						}
					} else {
						$this->$attr = (bool) $this->$attr;
					}
				} else if($this->type[$attr] === 'date' || $this->type[$attr] === 'datetime' || $this->type[$attr] === 'time') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					}

					$val = strtotime($this->$attr);

					if($val) {
						$this->$attr = $val;
					} else {
						$this->$attr = null;
					}
				} else {
					$this->$attr = $this->$attr;
				}

				// normalize
				if(is_array($this->normalize[$attr]) && is_string($this->$attr)) {
					// notrim
					if(in_array('trim', $this->normalize[$attr])) {
						$this->$attr = trim($this->$attr);
					}
					// lowercase
					if(in_array('lowercase', $this->normalize[$attr])) {
						$this->$attr = mb_strtolower($this->$attr);
					}
					// uppercase
					else if(in_array('uppercase', $this->normalize[$attr])) {
						$this->$attr = mb_strtoupper($this->$attr);
					}
					// capitalize
					else if(in_array('capitalize', $this->normalize[$attr])) {
						$this->$attr = mb_capitalize($this->$attr);
					}
				}

				// Empty string to null
				if(is_string($this->$attr) && $this->$attr === '') {
					$this->$attr = null;
				}
			} else {
				// set value
				$this->$attr = null;
			}
		}
	}

	/**
	 * Example is here ./tests/MyForm.php
	 *
	 * @return array
	 */
	abstract protected function type(): array;

	/**
	 * Example is here ./tests/MyForm.php
	 *
	 * @return array
	 */
	abstract protected function normalize(): array;
}

