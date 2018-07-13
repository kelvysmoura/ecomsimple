<?php

namespace Core;

class Helper {

    public static function redirect($to = ''){
        header("location: ".self::main_url($to));
    }

    public static function main_url($uri = ''){
        return MAIN_URL.$uri;
    }

    public static function assets_url($assets_file){
        return self::main_url("assets/{$assets_file}");
    }

    public static function array_trim($arr){
        return array_map('trim', $arr);
    }

    public static function isset_value($key, $arr, $else = null){
        return isset($arr[$key]) ? $arr[$key] : $else;
    }

    public static function b64_url_enconde($b64){
        return str_replace(['=', '_', '+', '-', '/', '\\'], '', base64_encode($b64));
    }

    public static function b64_url_decode($b64){
        return base64_decode($b64);
    }

    public static function hash_session_name(){
        return hash('md5', Input::server('remote_addr').Input::server('http_user_agent'));
    }

    public static function money_br($money){
        return number_format((float)$money, 2, ',', '.');
    }
    public static function money_db($money){
        return (float) str_replace(['.', ','], ['', '.'], $money);
    }
    public static function date_db($date){
        return implode('-', array_reverse(explode('/', $date)));
    }
    public static function date_br($date){
        return implode('/', array_reverse(explode('-', $date)));
    }
}