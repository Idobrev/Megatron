<?php 
class View {
	
	public $content; //if this is set you can access this var in the view you render throught $this->content
	
	public function __construct(){
		
	}
	
	/**
	 * Renders a view by given name
	 * @name  - name of the view
	 * @sessionCheck - checks whether to check if the user is logged or not. 
	 * @content - content transfered for the view
	 */
	 //TODO Must be fixed. Authentication modules should be an external thing
	public function render($name, $sessionCheck = true, $content = '') {
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
	public function render_withIncludes($views, $sessionCheck = true, $content = '') {
		$this->render_header();
		$this->render_navigator();
		if ( is_array ($views) ) {
			foreach ($views as $view) {
				$this->render($view, $sessionCheck, $content);
			}
		}else {
			$this->render($views, $sessionCheck, $content);
		}
		$this->render_footer();
	}
	public function render_header($content = '') {
		$this->render('header/header.php', false, $content);
	}
	
	public function render_navigator($content = '') {
		$this->render('navigator/index.php', false, $content);
	}
	
	public function render_footer($content = ''){
		$this->render('footer/footer.php', false, $content);
	}
}
?>