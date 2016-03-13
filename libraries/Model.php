<?php 
	/**
	 * 
	 */
	class Model {
		
		protected $db;
		
		function __construct() {
			require (LIBRARIES . 'Database.php');
			$config = $this->parseConfig();
			$this->db = new Database($config['host'], $config['dbname'], $config['username'], $config['password']);
		}
		/**
		 * Gets a given validator or the default one
		 * @param string / name of the validator
		 * @return object / instance of the validator
		 */
		public function getValidator($name = 'default') {
			//
			if ($name == 'default') { return new Validator();}
			require (VALIDATORS . $name . '_validator.php');
			$name = $name . '_Validator';
			return new $name();
		} 
		/**
		 * Parses the configuration file
		 * 
		 */
		private function parseConfig(){
			return parse_ini_file(BASE_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.ini');
		}
	}
	
 ?>