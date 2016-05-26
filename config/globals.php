<?php 
define('BASE_PATH', dirname(realpath(__DIR__)) . DIRECTORY_SEPARATOR);
define('LIBRARIES', BASE_PATH . 'libraries' . DIRECTORY_SEPARATOR);
define('CONTROLLERS', BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('VALIDATORS', BASE_PATH . 'validators' . DIRECTORY_SEPARATOR);
define('VIEWS', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);
define('MODELS', BASE_PATH . 'models' . DIRECTORY_SEPARATOR);
define('SETTINGS', BASE_PATH . 'settings' . DIRECTORY_SEPARATOR);
//Matches the public path to megatron.
	//Legacy for fun
	# $match = preg_match('/.+(?:\\\|\\/)www(\\\.+|\\/.+)/', BASE_PATH, $megatronFolder); // three escape slashes. Cuz fun is here, fun is now. Should work with 2 but we must escape the escape in regex . 
$match = preg_match('/(.+\/)Megatron(\/.*)?/', $_SERVER['PHP_SELF'], $absorbedUrlMatch);
if ($match === 1) {
	//ALL OF THE GLOBAL VARIABLES HERE REFER TO SOME SORT OF A PUBLIC URL ADRESS. The previous vars were just full paths 
	//refers to the path of the public folder of Megatron. EX: localhost/<yourweb>/Megatron/public or simply localhost/Megatron/public
	define('MEGATRON_BASE_URL', dirname($_SERVER['PHP_SELF']) . '/');
	define('PUBLIC_PATH', MEGATRON_BASE_URL . 'public' . '/');
	define('MODULES', MEGATRON_BASE_URL . 'modules' . '/' ); //lets try dis shit
	define('ABSORBED_WEB_URL', $absorbedUrlMatch[1]);
} else {
	echo "Unable to locate Megatron folder. Somehow we fucked it up. Check globals.php and .htaccess file";
	exit;
}
?>