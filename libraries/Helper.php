<?php
/**
 * 
 */	
class Helper {
	
	public static function printr($var){
		if (isset ($var) ) {
			print_r('<pre>');
			print_r($var);
			print_r('</pre>');
		}
	}
}

?>