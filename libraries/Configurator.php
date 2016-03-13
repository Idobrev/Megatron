<?php
/**
 * 
 */
class Configurator {
	
	/* Holds configuration */
	private static $config = array();
	
	/**
	 * Parses ( reads ) all of the configuration file ( all that ends with .ini ) in config dir
	 */
	static function parseConfiguration() {
		$configDir =  BASE_PATH . 'config';
		$files = scandir($configDir);
		foreach ($files as $file) {
			if (strpos($file, '.ini') !== FALSE) {
				self::$config[$file] = parse_ini_file(BASE_PATH . 'config' . DIRECTORY_SEPARATOR . $file, true);		
			}
		}
		if (empty(self::$config)) {
			throw new MegatronException("No configuration found. Default config.ini file must be present at all cost", 1);
		}
	}
	/**
	 * Gets a field from the config.ini file 
	 * @param section - which section to look for
	 * @param field - for which field to look for
	 */
	static function getField($section, $field) {
		//no section can be empty
		if ($section == '' && $field == '')
		throw new MegatronException("Section or field is empty string. Wrong section: '{$section}' or field: {$field}", 1);
		foreach (self::$config as $configFiles) {
			if ( isset($configFiles[$section][$field]) ) {
				$foundField = $configFiles[$section][$field];
				break;
			}	
		}
		//we didnt find anything
		if ($foundField === NULL)
		throw new MegatronException("Field not found in configuration file. Wrong section: '{$section}' or field: {$field}", 1);
		return $foundField;
	}
	 
	 /**
	 * Set an already existing field in the config.ini file
	 * @param section - which section to look for
	 * @param field - for which field to look for
	 * @param value - the value to be changed to  
	 */
	static function setField($section, $field, $value) {
		
	}
}

?>