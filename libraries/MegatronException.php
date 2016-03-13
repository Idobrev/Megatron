<?php 
class MegatronException extends Exception {
	public function errorMessage() {
	    //error message
	    $errorMsg = 'MegatronException: Error on line '.$this->getLine().' in '.$this->getFile() . ' ' .$this->getMessage();
	    return $errorMsg;
  	}
}
?>