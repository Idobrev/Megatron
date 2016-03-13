<?php 
	class Session {
		
		public static function init() {
			session_start();
		}
		
		public static function set($key, $value) {
			$_SESSION[$key] = $value;
		}
		
		public static function destroy() {
			session_destroy();
		}
		
		public static function get($key) {
			return $_SESSION[$key];
		}
		
		public static function logged()	{
			//remember to check if the value of logged with a md5 or smtn. To confirm to log is secure!
			if (isset($_SESSION['logged'])) {
				return true;
			}
			return false;
		}
		
		public static function getUserLevel() {
			if (isset ($_SESSION['level'])) {
				return $_SESSION['level'];
			}
			return false;
		}
	}
 ?>