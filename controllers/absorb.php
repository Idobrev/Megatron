<?php
/**
 * Absorb controller.
 * Default controller when Megatron is in absorb mode.
 */
class Absorb extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	/**
	 * Main function that is called whenever Megatron is in absorb mode
	 */
	public function index($absorbedUrl) {
		$content = file_get_contents( BASE_PATH . '..' . DIRECTORY_SEPARATOR . $absorbedUrl);
		$moduleDirectives = $this->searchForMegatronModuleDirective($content);
		if ($moduleDirectives != FALSE) { //means we found no directives, thus we need to leave the page alone
			$this->installModules($content, $moduleDirectives);	
		}//else nothing, because we do not want to harm the page
		echo $content;
	}
	/**
	 * Search for module directives in the absorbed html code
	 */
	private function searchForMegatronModuleDirective($content) {
		$matched = preg_match_all('/megatron-module=(?:\'|\")(.*)(?:\'|\")/', $content, $matches);
		$directives = FALSE;
		if ($matched != 0) {
			foreach ($matches[1] as $directive) {
				$directives[$directive] = $directive;
			}
		}
		return $directives;
	}
	
	/**
	 * Gets the install script for the url
	 */
	private function getModulesInstallTag($moduleDirectives) {
		#file_get_contents(BASE_PATH . DIRECTORY_SEPARATOR . )
		$installedModules = Configurator::getField(Constants::MEGATRON_SECTION, Constants::MEGATRON_FIELD_INSTALLED_MODS);
		$scriptTag = '';
		foreach ($installedModules as $installedModule) {
			if (in_array($installedModule, $moduleDirectives)) {
				$scriptTag .= "<script src='" . MODULES . "{$installedModule}/install.js'></script>\n\t";
			}
		}
		return $scriptTag;
	}
	
	/**
	 * Default function to install all the modules
	 */
	private function installModules(&$content, $moduleDirectives) {
		$installTags = $this->getModulesInstallTag($moduleDirectives);
		if (strpos($content, '</body>') !== FALSE) {
			$content = preg_replace('/(\s)(<\/body>)/', '${1}' . $installTags . '${2}', $content);	
		}else {
			$content .= $installTags;
		}
	}
}

?>