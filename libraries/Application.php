<?php
class Application {

	public $url;
	private $controllerName; //holds our current controller to be called
	private $methodName; //holds the current method to be called
	private $methodArgs; //holds the current args to be called
	
	/**
	 * Starts the session
	 */
	public function startSession() {
		if (!isset($_SESSION)){
			Session::init();
		}
	}
	/**
	 * Simple parsing of URL
	 */
	public function parseURL() {
		if (!isset($_GET['url'])){header('Location: index');}
		$url = $_GET['url'];
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->url = new stdClass();
		$this->url->controllerName = $url[0];
		@$this->url->method = $url[1];
	}
	
	/**
	 * Invokes configurator to parse the configuration or throws an error
	 */
	public function readConfiguration() {
		try {
			Configurator::parseConfiguration();	
		} catch (MegatronException $e){
			echo $e->errorMessage();
			exit;
		}
	}
	
	/**
	 * Validates url and calls the controller 
	 */
	public function callController() {
		$controllerName = $this->url->controllerName; // contains our controller main
		$method = $this->url->method; //the method we are going to invoke from our controller
		$args = ''; //arguments to be passed to our invoked method
		try {
			//checks if we are in absorb mode. In this mode Megatron will only invoke the absorb controller.
			if ( $this->checkForAbsorbMode() ) {
				$controllerName = 'absorb';
				$method = 'index';
				$args = $_GET['url'];
			}
			//checks if we are in install mode. In install mode Megatron will only invoke the install conroller.
			if ( $this->checkForInstallMode() ) {
				$controllerName = 'install';
				$method = 'index';
			}
			// actually call the controllers. 
			if (file_exists(CONTROLLERS . $controllerName . '.php') ) {
				require(CONTROLLERS . $controllerName . '.php');
	        	$controller = new $controllerName;
				#$controller = new ReflectionClass($controllerName);
				if (!empty($method)) {
					$this->callMethod($controller, $method, $args);
				}else {
					$this->callMethod($controller, 'index', $args);
				}
			}else {
				$this->callErrorController();
			}
		} catch (MegatronException $e) {
			//TODO Developer mode can just be placed here. If in dev mode display all that, if not display an user frendly error.
			echo $e->errorMessage();
			echo "<br><pre>" . $e->getTraceAsString() . "</pre>";
			exit;
		}
	}

	/**
	 * Checks if megatron is in install mode. Can be configured through the config.
	 */
	private function checkForInstallMode() {
		//checks if we are in install mode. 
		if ( Configurator::getField(Constants::MEGATRON_SECTION, Constants::MEGATRON_FIELD_IS_INSTALLED) != FALSE) { 
			return false;
		}
		return true;
	}
	 
	 
	/**
	 * Checks if megatron is in absorb mode. Can be configured and the config must incluse a list of absorb files.
	 */
	private function checkForAbsorbMode () {
		//checks if we are in absorb mode. In this mode Megatron will only invoke the absorb controller.
		if ( Configurator::getField(Constants::MEGATRON_SECTION, Constants::MEGATRON_FIELD_ABSORB_MODE) != TRUE ) {
			return false;
		}
		//if megatron is in absorb mode but the resource is not in the list of absorbed files (from the config), we must not touch the file
		if ( $this->checkUrlForAbsorbation($_GET['url']) == FALSE) {
			//we must redirect the server to request the given url
				//TODO fix this redirect or make the installer work
				//header('Location: ' . ABSORBED_WEB_URL);
				//exit;
			return false;
		}
		return true;
	}

	/**
	 * Calls the method of the current controller
	 */
	private function callMethod($controller, $method, $args) {
		try {
			if (method_exists($controller, $method)){
				$controller->{$method}($args);
			}else {
				$this->callErrorController();
			}
		} catch (MegatronException $e){
			echo $e->errorMessage();
			exit;
		}
	}
	
	private function setControllerArgs($name, $method, $args) {
		
	}
	/**
	* Checks whether the url we have should be scaned and absorbed
	*/
	private function checkUrlForAbsorbation($url) {
		$urlsToAbsorb = Configurator::getField(Constants::MEGATRON_SECTION, Constants::MEGATRON_FIELD_ABSORBED_URLS);
		if (in_array($url, $urlsToAbsorb)) {
			return true;
		}
		return false;
	}
	
	/**
	 * Calls the error controller by default
	 */
	private function callErrorController() {
		require(CONTROLLERS . 'error.php');
		$err = new Error();
		$err->err_undefinedURL();
	}
}
?>