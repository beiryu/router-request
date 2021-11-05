<?php



use Fresher\Core\Router;



error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('CET');




// defines the web root
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/index.php')));
// defines the path to the files
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
// defines the cms path
define('CMS_PATH', ROOT_PATH . '/core/');
// includes the system routes. Define your own routes in this file
include(ROOT_PATH . '/routes/routes.php');




/**
 * Standard framework autoLoader
 * @param string $className
 */
function autoLoader($className) {
	
	// parse namespace
	$arr = explode("\\", $className);
	$className = end($arr);
	if (strlen($className) > 10 && substr($className, -10) == 'Controller') {
		if (file_exists(ROOT_PATH . '/source/controllers/' . $className . '.php')) {
			require_once ROOT_PATH . '/source/controllers/' . $className . '.php';
		}
	}
	else if (file_exists(CMS_PATH . $className . '.php')) {
		require_once CMS_PATH . $className . '.php';
	}
}
spl_autoload_register('autoLoader');





$router = new Router();
$router->execute($routes);
$controller = $router->getController();
$controller->execute();