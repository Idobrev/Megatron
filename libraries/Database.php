<?php 
	/**
	 * 
	 */
	class Database extends PDO{
		
		public function __construct($host, $dbName, $username, $password) {
			try { 
				parent::__construct("mysql:host={$host};dbname={$dbName}", $username, $password);
			}catch (MegatronException $e) {
				throw new MegatronException("Unable to connect to db using PDO client", 1);
				exit;
			}
		}
		
		/* dis shit doesn't work*/
		public function __prepare ($sth, Array $params) {
			foreach ($params as $field => &$value){ $sth->bindParam(':' . $field, $value); }
		}
	}
	
 ?>