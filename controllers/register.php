<?php 
	/**
	 * 
	 */
	class Register extends Controller {
		//TODO Make functions for each wrong input field!!!!
		function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$this->view->render_withIncludes('authentication/register.php', false);
		}
		
		public function user_registration() {
			if ($this->model->user_registration() ) {
				$this->view->render_withIncludes('authentication/succesful_registration.php', false);
			}else {
				$this->wrongInputFields();
			}
		}
		
		public function wrongInputFields() {
			$this->view->render_withIncludes('authentication/wrongInputFields.php', false);
		}
	}
	
 ?>