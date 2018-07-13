<?php

namespace Core;

class Router{

    private static $controller;
    private static $method;
    private static $param = [];

    public static function uri(){
        $uri = isset($_GET['uri']) ? $_GET['uri'] : MAIN_CONTROLLER."/";
        $uri = explode('/', $uri.'/');
        self::$controller = str_replace('-', '_', ucfirst($uri[0]));
        self::$method = (isset($uri[1]) && $uri[1] !== '') ? str_replace('-', '_', $uri[1]) : 'def';
        unset($uri[0], $uri[1]);
        self::$param = $uri;
        return [self::$controller, self::$method, self::$param];
    }

    public static function controller_exists($controller, $error){
        $exists = CONTROLLERS_PATH."{$controller}.php";
        return file_exists($exists) ? "\\App\\Controllers\\{$controller}" : "\\App\\Controllers\\{$error}";
    }
}