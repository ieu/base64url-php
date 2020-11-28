<?php

/**
 * @see https://github.com/firebase/php-jwt/blob/master/src/JWT.php
 */
function base64url_encode($data) {
	return strtr(base64_encode($data), '+/', '-_');
}

/**
 * @see https://github.com/firebase/php-jwt/blob/master/src/JWT.php
 */
function base64url_decode($data, $strict = false) {
	return base64_decode(strtr($data, '-_', '+/'), $strict);
}