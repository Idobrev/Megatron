<?php 
class Error extends Controller {
	//TODO Error controller is not working properly. It needs to accept in his constructor atleast the method needed to be called.
	public function __construct(){
		parent::__construct();
	}
	
	public function index (){
		$this->view->render_withIncludes('error/index.php', false);
	}
	
	public function err_undefinedURL() {
		$this->view->render('error/undentifiedUrl.php', false);
	}
	
	public function SQLError() {
		$this->view->render('error/SQLError.php', false);
	}
}
?>