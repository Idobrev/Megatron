<?php 
	/**
	 * Login controller
	 */
	class Login extends Controller {
		
		public function __construct(){
			parent::__construct();
		}
		
		public function authenticate(){
			$userInfo = $this->model->authenticate();
			if ($userInfo !== false) {
				Session::set('logged', $userInfo->user_id);
				Session::set('level', $userInfo->user_level);
				Session::set('fname', $userInfo->user_fname);
				Session::set('lname', $userInfo->user_lname);
				Session::set('email', $userInfo->user_email);
				Session::set('token', $userInfo->user_token);
				$this->view->render_withIncludes('authentication/succesful_authentication.php', TRUE);
			}else {
				$this->view->render_withIncludes(array ('error/unableToAuthenticate.php', 'authentication/loggedOut.php'), false);
			}
		}
		
		public function logout(){
			Session::destroy();
			$this->view->render_withIncludes('authentication/succesful_logout.php', false);
		}
	}
	
 ?>