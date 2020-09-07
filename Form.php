<?php

/**
 * Form
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */


/**
 * Form
 */
abstract class Form
{
	/**
	 * Types
	 */
	private $__types;

	/**
	 * Normalize
	 */
	private $__normalize;

	/**
	 * Data
	 */
	private $__data;

	/**
	 * Constructor
	 *
	 * @param array $data Data
	 */
	public function __construct(array $data)
	{
		$this->__data = $data;
		$this->construct($this->__data);
	}

	/**
	 * Set types and normalize input data
	 *
	 * @param array $data Data
	 *
	 * @return void
	 */
	private function construct(array $data): void
	{
		$this->__types = method_exists($this, 'types') ? $this->types() : [];
		$this->__normalize = method_exists($this, 'normalize') ? $this->normalize() : [];

		foreach(array_keys(get_object_vars($this)) as $attr) {
			if(isset($data[$attr]) && !is_null($data[$attr])) {
				// set value
				$this->$attr = $data[$attr];

				// set type
				if($this->__types[$attr] === 'string' || $this->__types[$attr] === 'str') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					} else {
						$this->$attr = (string) $this->$attr;
					}
				} else if($this->__types[$attr] === 'integer' || $this->__types[$attr] === 'int') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					} else {
						$this->$attr = (int) $this->$attr;
					}
				} else if($this->__types[$attr] === 'float' || $this->__types[$attr] === 'double' || $this->__types[$attr] === 'real') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					} else {
						$this->$attr = (int) $this->$attr;
					}
				} else if($this->__types[$attr] === 'boolean' || $this->__types[$attr] === 'bool') {
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
				} else if($this->__types[$attr] === 'date' || $this->__types[$attr] === 'datetime' || $this->__types[$attr] === 'time') {
					if(is_string($this->$attr) && trim($this->$attr) === '') {
						$this->$attr = null;
					}

					$val = strtotime($this->$attr);

					if($val) {
						$this->$attr = $val;
						$this->$attr = date('Y-m-d H:i:s', $this->$attr);
						$this->$attr = new DateTime($this->$attr);
					} else {
						$this->$attr = null;
					}
				} else {
					$this->$attr = $this->$attr;
				}

				// normalize
				if(is_array($this->__normalize[$attr]) && is_string($this->$attr)) {
					// notrim
					if(in_array('trim', $this->__normalize[$attr])) {
						$this->$attr = trim($this->$attr);
					}
					// lowercase
					if(in_array('lowercase', $this->__normalize[$attr])) {
						$this->$attr = mb_strtolower($this->$attr);
					}
					// uppercase
					else if(in_array('uppercase', $this->__normalize[$attr])) {
						$this->$attr = mb_strtoupper($this->$attr);
					}
					// capitalize
					else if(in_array('capitalize', $this->__normalize[$attr])) {
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
	 * Get data
	 *
	 * @return array
	 */
	public function getData(): array
	{
		return array_filter(get_object_vars($this), function($k) {
			return $k !== '__normalize' && $k !== '__types' && $k !== '__data';
		}, ARRAY_FILTER_USE_KEY);
	}
}

