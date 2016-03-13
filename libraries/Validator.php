<?php 
/**
 * 
 */
class Validator {
	
	function __construct() {}
	
	
	/**
	 * Sanitizes strings
	 * @return string. The sanitized string
	 */
	public function sanitize_string($string, $length) {
		$string = trim($string);
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		if (mb_strlen($string) < $length) {return false;}
		return $string;
	}
	/**
	 * Validates email with php internal validation, no domain validation
	 */
	public function validate_email($email) {
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($email === false){return false;}
		return $email;
	}
	
	/**
	 * Validates password if it contains 1 Upper case 1 digit and if its bigger or equal to 8
	 */
	public function validate_password($password) {
		if (preg_match('/[A-Z\p{Cyrillic}]/u', $password) && preg_match('/\d/', $password) && preg_match('/[a-z\p{Cyrillic}]/u', $password) && mb_strlen($password) >= 8 ) {
			return $password;
		}
		return false;
	}
	
	/**
	 * @return false if its not a number / '1' if its a numeric integer / '2' if its below or equal the maxValue 
	 * 
	 */
	public function validate_numeric ($number, $maxValue = ''){
		if (is_numeric($number) || is_double($number)) {
			if ($maxValue != '' && $number <= $maxValue) {
				return 2;
			}
			return 1;
		}
		return false;
	}
	
}

 ?>