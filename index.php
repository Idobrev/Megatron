<?php
error_reporting(E_ALL);
require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'globals.php');
//Libraries
require (LIBRARIES . 'Application.php');
require (LIBRARIES . 'Controller.php');
require (LIBRARIES . 'View.php');
require (LIBRARIES . 'Model.php');
require (LIBRARIES . 'Session.php');
require (LIBRARIES . 'Validator.php');
require (LIBRARIES . 'MegatronException.php');
require (LIBRARIES . 'Configurator.php');
require (LIBRARIES . 'Helper.php');
require (SETTINGS . 'Constants.php');

$application = new Application();
$application->readConfiguration();
$application->startSession();
$application->parseURL();
$application->callController();

//$application->renderView();
//echo BASE_PATH;

?>