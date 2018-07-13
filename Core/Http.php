<?php

namespace Core;

class Http{

     private static $http_msg = array(
        200 => "Ok",
        400 => "Bad Request",
        401 => "Unauthorized",
        405 => "Method Not Allowed"
    );

    private static $http_success = array(200, 201);
    
    public static function response($content = [], $code = 200){
        self::status_code($code);
        $res = array(
            'error' => !in_array($code, self::$http_success),
            'data' => $content
        );
        echo Output::json_enc(array_merge(self::response_http($code), $res)); exit;
    }
    
    public static function response_http($code = 200){
        return array('http' => array('code' => $code, 'msg' => self::$http_msg[$code]));
    }

    public static function status_code($code = 200){
        http_response_code($code);
    }
}