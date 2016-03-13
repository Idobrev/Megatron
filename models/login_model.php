<?php 
	/**
	 * 
	 */
	class Login_model extends Model {
		
		private $userFields = array();
		
		function __construct() {
			parent::__construct();	
			$this->val = $this->getValidator('login');
		}
		/**
		 * Authentication model main function
		 */
		public function authenticate(){
			if ( !$this->validateInputFields() )return FALSE;
			return $this->getUserInformation();
		}
		
		/**
		 * Validates the input fields
		 */
		private function validateInputFields() {
			$this->userFields = $this->val->val_loginFields($_POST);
			//we got error on validation
			if ($this->userFields == FALSE) { return false; }
			//TODO ERROR HANDLING. COME OOON
			return true;
		}
		
		/**
		 * Gets the user info from the database
		 */
		private function getUserInformation() {
			$sth = $this->db->prepare("SELECT user_id, user_fname, user_lname, user_level, user_token, user_email FROM `users` WHERE user_name = :uname and `user_password` = SHA1(:pass);");
			//binding all params. Using the keys and adding : to them so i can bind
			$sth->bindParam(':uname', $this->userFields['uname']);
			$sth->bindParam(':pass' , $this->userFields['pass']);
			//execute
			$sth->execute();
			//test for error
			$error = $sth->errorInfo();
			if (!empty($error[2])){
				//TODO Do something when the user has wrong credentials?!?!!? IVANE WTF?!!?!
				var_dump('something with the database.', $error);
				return false;
			}
			return $sth->fetchObject();
		}
		
	}
	
 ?>