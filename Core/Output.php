<?php

namespace Core;

class Output{

   
    public static function json_enc($data_encode = []){
        return json_encode($data_encode, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }
    
    public static function json_dec($data_decode = []){
        return json_decode($data_decode);
    }
    
    public static function content_type($content){
        header("Content-type: {$content}");
    }
    
    public static function header($header = null){
        header($header);
    }
}