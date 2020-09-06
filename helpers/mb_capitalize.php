<?php

/**
 * Multi-bytes capitalize
 *
 * @author Nurasyl Aldan <nurassyl.aldan@gmail.com>
 *
 * @link https://gist.github.com/nurassyl/cf89610f878e45679f6a2cc6a4a5d879
 */


/**
 * Capitalize string
 *
 * @param string $string Value
 *
 * @return string
 */
function mb_capitalize($string) {
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_strtolower(mb_substr($string, 1));
	return $string;
}

