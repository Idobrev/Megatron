<?php 
class Controller {
	
	protected $view;
	protected $model;

	protected function __construct(){
		//var_dump('Main Controller');
		$this->view = new View();
		$this->callModel(get_class($this));
	}
	
	private function callModel($controller){
		if ( file_exists(MODELS . $controller . '_model.php') ) {
			require(MODELS . $controller . '_model.php');
			$model = $controller . '_model';
			$this->model = new $model;
		}else {
			throw new MegatronException("Unable to find corresponding model: {$controller}. Please create a correspoding '{$controller}_model.php' file", 1);
		}
	}
}
?>