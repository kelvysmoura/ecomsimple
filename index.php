<?php
date_default_timezone_set('America/Fortaleza');

define('ROOT_SITE', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

require ROOT_SITE."constants.php";
require VENDOR_PATH."autoload.php";


use Core\Router;

list($controller, $method, $param) = Router::uri();

$appController = Router::controller_exists($controller, 'Controller_not_found');

$controller = new $appController();

if(method_exists($controller, $method)){
    $controller->$method(...$param);
}
else{
    die("404 - method {$method} Não existe");
}
