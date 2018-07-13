<?php

namespace Core;

class Input{
    
    
    public static function post($post = null, $filter = FILTER_DEFAULT, $options = null){
        if(is_null($post)){
            return filter_input_array(INPUT_POST, $filter);
        }
        else{
            return filter_input(INPUT_POST, $post, $filter, $options);
        }
    }

    public static function files($name = null){
        return is_null($name) ? $_FILES : $_FILES[$name];
    }
    
    
    public static function method($method = null){
        $request_method = self::server('request_method');
        return is_null($method) ? $request_method : ($request_method === strtoupper($method));
    }

    public static function server($key = null){
        return is_string($key) ? $_SERVER[strtoupper($key)] : $_SERVER;

    }
}