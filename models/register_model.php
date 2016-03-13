<?php 
	class Register_model extends Model {
		
		/* $this->db (PDO object)*/
		
		/* validator */
		private $val;
		/* user fields */
		private $userFields = array();
		
		
		public function __construct(){
			parent::__construct();	
			$this->val = $this->getValidator('register');
		}
		
		/**
		 * Used for REGISTRATION.
		 */
		public function user_registration() {
			//this will blow us the error
			if ( !$this->validateInputFields() )return false;
			
			//get us a nice juicy token
			$this->userFields['token'] = $this->generateUniqueToken();
			
			//lets insert our user's information into the database. It will return true or false and its ok for us to return it as well.
			return $this->insertUserInfo();
			//TODO DO SOMETHING WHEN WE HAVE AN ERROR. Come on maan..
		}
		
		/**
		 * Validates the input fields using the regist validator
		 */ 
		private function validateInputFields() {
			$this->userFields = $this->val->val_postFields($_POST);
			// if error after validation
			if ($this->userFields == false) { var_dump('something with the user input.'); return false;}	
			return true;
		}
		
		/**
		 * Write the user information into the db
		 */
		
		private function insertUserInfo() {
			//prepare the query
			$sth = $this->db->prepare("INSERT INTO `users`(`user_id`, `user_name`, `user_fname`, `user_lname`, `user_email`, `user_password`, `user_token`) VALUES ('',:uname,:fname,:lname,:email,SHA1(:pass),:token);");
			//binding all params. Using the keys and adding : to them so i can bind
			foreach ($this->userFields as $field => &$value){ $sth->bindParam(':' . $field, $value); }
			//execute
			$sth->execute();
			//test for error
			$error = $sth->errorInfo();
			if (!empty($error[2])){
				//put something here, like constants with errors
				var_dump('something with the database.', $error);
				return false; 
			}else {
				return true;
			}
		}
		
		/**
		 * Generates 128bit token
		 */
		private function generateUniqueToken() {
			return bin2hex(openssl_random_pseudo_bytes(16));
		}

	}
 ?>