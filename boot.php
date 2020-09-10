<?php

/**
 * Bootstrap
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 */


/**
 * String encoding
 */

$encoding = 'UTF-8';

mb_internal_encoding($encoding);
mb_http_output($encoding);
mb_http_input($encoding);
mb_regex_encoding($encoding);


/**
 * Set datetime parameters
 */

date_default_timezone_set('UTC');


/**
 * Error reporting
 */

error_reporting(E_ALL & ~E_NOTICE);


/**
 * Autoload classes
 */

spl_autoload_register(function ($class_name) {
	$class_name = str_replace('\\', '/', $class_name);

	include_once __DIR__ . '/' . $class_name . '.php';
});


/**
 * Helpers
 */

require_once(__DIR__ . '/helpers/mb_capitalize.php');

