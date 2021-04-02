<?php

define('WEBROOT', str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define('ROOT404',ROOT.'mvc/Views/Parts/404.php');

if(isset($_GET['p'])) {
$params = explode('/', $_GET['p']);	
foreach ($params as &$value) {
	$explode = explode('@',str_replace(["-","_"], "@", $value));
	$value = $explode[0];
	unset($explode[0]);
	foreach ($explode as $explodeChar) {
		$value .=ucfirst($explodeChar);
	}
}
}
else {
	$params = ['products','index'];
}


if(isset($params[0]) && !empty($params[0])) {
	$controller = $params[0];
}

if ($controller == "admin" && empty($params[1])) {
	$params[1] = 'index';
}

require_once(ROOT.'mvc/Controllers/controller.php');
require(ROOT.'mvc/Models/model.php');
require(ROOT.'mvc/controllers/'.$controller.'.php');
$controller = new $controller();

if(isset($params[1]) && method_exists($controller, $params[1])) {
	$action = $params[1];

	$r = new ReflectionMethod($controller, $action);
	$parameters = $r->getParameters();



	if(empty($parameters)) {
		$controller->$action();
	}
	else {
		if(isset($params[2]) && !empty($params[2])) {
			$controller->$action($params[2]);
		}
		else {
			 header('HTTP/1.0 404 Not Found');
	 include(ROOT404);
    exit;
		}
	}
}
else {
	 header('HTTP/1.0 404 Not Found');
	 include(ROOT404);
    exit;
}

