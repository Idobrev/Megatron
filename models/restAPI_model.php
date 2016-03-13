<?php
/**
 * 
 */
class RestAPI_model extends Model {
	
	/* $this->db (PDO object)*/
	
	function __construct() {
		parent::__construct();
	}
	
	public function getFreeSpotsFromDB($lat, $lng) {
		$val = $this->getValidator('default');
		$lat = $val->sanitize_string($lat, 1);
		$lng = $val->sanitize_string($lng, 1);
		if ($val->validate_numeric($lat, 80) == 2 &&  $val->validate_numeric($lng, 180) == 2){
			// do request
			$sth = $this->db->prepare("Select * from `freespots`;");
			$sth->execute();
			$error = $sth->errorInfo();
			$result = $sth->fetchAll();
			if (!empty($error[2])){
				throw new MegatronException("Query failed", 1);
			}
			return $result;
		}else {
			throw new MegatronException(" Not coordinates, either you are fucking with the system or you are gay. Second is more possible.", 1);
		}
	}
	
	public function verifyTokenAuthentication($token) {
		$val = $this->getValidator('default');
		$token = $val->sanitize_string($token, 32);
		// do request
		$sth = $this->db->prepare("Select * from `users` where user_token = :token;");
		$sth->bindParam(':token', $token);
		$sth->execute();
		$error = $sth->errorInfo();
		$result = $sth->fetchObject();
		if (!empty($error[2])){
			//TODO throw web exeptions - they must be in json format, but do it properly
			return FALSE;
		}
		return $result ? true : false;
	}
}
 
?>