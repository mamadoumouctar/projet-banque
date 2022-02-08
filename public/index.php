<?php
session_start();
define('ROOT', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

date_default_timezone_set('UTC');
require '../vendor/autoload.php';
require '../routes.php';
use Tm\Router;

$result = Router::getRouter()->match();
try{
	if($result) echo call_user_func_array($result['target'], $result['params']);
	else{
		$controller = new Tm\Controller\controller();
		echo $controller->notFoundResponse();
	}
}catch(Error $e){
	echo "Il y'a eu un problème au niveau du serveur";
}
