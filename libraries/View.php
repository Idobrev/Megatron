<?php 
class View {
	
	public function __construct(){
		
	}
	
	public function render($name, $sessionCheck = true) {
		if ($sessionCheck){
			if (Session::logged()){
				require (VIEWS . 'authentication/loggedIn.php');
			}else {
				Session::destroy();
				require (VIEWS . 'authentication/loggedOut.php');
				return;
			}
		}
		require (VIEWS . $name);
	}
	/**
	 * Renders including a headers and footer
	 * @renderView - if its a string, it will render 1 view, if array it will iterate through all views and will render header first and footer last
	 */
	public function render_withIncludes($views, $sessionCheck = true) {
		$this->render_header();
		$this->render_navigator();
		if ( is_array ($views) ) {
			foreach ($views as $view) {
				$this->render($view, $sessionCheck);
			}
		}else {
			$this->render($views, $sessionCheck);
		}
		$this->render_footer();
	}
	public function render_header() {
		require (VIEWS . 'header/header.php');
	}
	
	public function render_navigator() {
		require (VIEWS . 'navigator/index.php');
	}
	
	public function render_footer(){
		require (VIEWS . 'footer/footer.php');
	}
}
?>