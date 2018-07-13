<?php

namespace Core;

class Load {

    public static function model($model){
        $model = ucfirst($model);
        $appModel = "\\App\\Models\\{$model}";
        if(file_exists(MODELS_PATH."{$model}.php")){
            return new $appModel();
        }
        else{
            die($appModel.' n encontrado');
        }
    }

    public static function view($view, $param = []){
        if(is_array($param) && !empty($param)){
            foreach($param as $k => $v){
                $$k = $v;
            }
        }
        require VIEWS_PATH."{$view}.php";
    }
}