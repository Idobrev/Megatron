<?php 
	class Login_Validator extends Validator{
		
		public function __construct() {}
		
		public function val_loginFields($filteredPost){
			$validatedFields = array();
			$validatedFields['uname'] = $this->sanitize_string($filteredPost['uname'], 4);
			$validatedFields['pass'] = $this->validate_password($filteredPost['pass']);
			if (count(array_filter($validatedFields)) != 2) {return false;}
			return $validatedFields;
		}
	}
 ?>