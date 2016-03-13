<?php
class GoogleMap extends Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
		$this->view->render_withIncludes('googleMap/googleMap.php', false);
	}
}
?>