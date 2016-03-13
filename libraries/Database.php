<?php 
	/**
	 * 
	 */
	class Database extends PDO{
		
		public function __construct($host, $dbName, $username, $password) {
			parent::__construct("mysql:host={$host};dbname={$dbName}", $username, $password);
		}
		
		/* dis shit doesn't work*/
		public function __prepare ($sth, Array $params) {
			foreach ($params as $field => &$value){ $sth->bindParam(':' . $field, $value); }
		}
	}
	
 ?>