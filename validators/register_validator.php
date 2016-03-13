<?php 
	class Register_Validator extends Validator{
		
		public function __construct() {}
		/**
		 * Validates the registration post fields. 
		 * Returns False or error or array with the fields
		 * 
		 */
		public function val_postFields($filteredPostParams){
			$validatedPosts = array();
			$validatedPosts['uname'] = $this->sanitize_string($filteredPostParams['uname'], 4);
			$validatedPosts['fname'] = $this->sanitize_string($filteredPostParams['fname'], 4);
			$validatedPosts['lname'] = $this->sanitize_string($filteredPostParams['lname'], 4);
			$validatedPosts['email'] = $this->validate_email($filteredPostParams['email']);
			if (strcmp($filteredPostParams['pass1'], $filteredPostParams['pass2']) !== 0) {
				$validatedPosts['pass'] = false;
				
			}else {
				$validatedPosts['pass'] = $this->validate_password($filteredPostParams['pass1']);
			}
			//if something went wrong durring validation
			if (count( array_filter($validatedPosts) ) != 5 ) {
				return false;
			}
			return $validatedPosts;
		}
	}
 ?>