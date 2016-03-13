<?php 
	/**
	 * 
	 */
	class FreeSpots extends Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$this->view->render_withIncludes('freeSpots/index.php');
		}
	}
	
 ?>