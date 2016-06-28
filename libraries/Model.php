<?php 
	/**
	 * 
	 */
	class Model {
		
		protected $db;
		
		function __construct() {
			//Only if using a database, we make a db instance
			
            if ( Configurator::getField(Constants::MEGATRON_SECTION, 'usedb') == 1 ) {
                require (LIBRARIES . 'Database.php');
				try {
                	$this->db = new Database(Configurator::getField('Database', 'host'), Configurator::getField('Database', 'dbname'), Configurator::getField('Database', 'username'), Configurator::getField('Database', 'password'));
				}catch (PDOException $e) {
					throw new MegatronException("Unable to find proper database. Check configuration file.", 1);
				}
            }
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