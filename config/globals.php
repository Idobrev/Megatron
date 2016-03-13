<?php 
define('BASE_PATH', dirname(realpath(__DIR__)) . DIRECTORY_SEPARATOR);
define('LIBRARIES', BASE_PATH . 'libraries' . DIRECTORY_SEPARATOR);
define('CONTROLLERS', BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('VALIDATORS', BASE_PATH . 'validators' . DIRECTORY_SEPARATOR);
define('VIEWS', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);
define('MODELS', BASE_PATH . 'models' . DIRECTORY_SEPARATOR);
define('SETTINGS', BASE_PATH . 'settings' . DIRECTORY_SEPARATOR);
//Matches the public path to megatron.
$match = preg_match('/.+(?:\\\|\\/)www(\\\.+|\\/.+)/', BASE_PATH, $megatronFolder); // three escape slashes. Cuz fun is here, fun is now. Should work with 2 but we must escape the escape in regex
if ($match === 1) {
	//ALL OF THE GLOBAL VARIABLES HERE REFER TO SOME SORT OF A PUBLIC URL ADRESS. The previous vars were just full paths 
	//refers to the path of the public folder of Megatron. EX: localhost/<yourweb>/Megatron/public or simply localhost/Megatron/public
	define('PUBLIC_PATH', str_replace('\\', '/', $megatronFolder[1]) . 'public' . DIRECTORY_SEPARATOR);
	define('MODULES', str_replace('\\', '/', $megatronFolder[1]) . 'modules' . '/' ); //lets try dis shit
	define('URL', str_replace('\\', '/', $megatronFolder[1]));
} else {
	throw new MegatronException("Unable to locate 'www' folder", 1);
}
?>