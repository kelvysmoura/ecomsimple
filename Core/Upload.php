<?php

namespace Core;

class Upload{

    private static $file_info = [];

    private static $upload_errors = array(
        UPLOAD_ERR_INI_SIZE => 'Tamanho do arquivo muito grande',
        UPLOAD_ERR_FORM_SIZE => 'Tamanho do arquivo muito grande',
        UPLOAD_ERR_PARTIAL => 'O upload do arquivo foi feito parcialmente.',
        UPLOAD_ERR_NO_FILE => 'Nenhum arquivo foi enviado',
        UPLOAD_ERR_NO_TMP_DIR => 'Error no upload. Contate o administrador do site!',
        UPLOAD_ERR_CANT_WRITE => 'Error no upload. Contate o administrador do site!',
        UPLOAD_ERR_EXTENSION => 'Error no upload. Contate o administrador do site!',
    );

    public static function init($ipt_name){
        self::$file_info = Input::files($ipt_name);
    }

    public static function file_info($key = null){
        return is_null($key) ? self::$file_info : self::$file_info[$key];
    }

    public static function check($rules = null){
        $extension = self::check_extension(Helper::isset_value('extension', $rules));
        if(in_array(self::file_info('error'), array_keys(self::$upload_errors))){
            return self::$upload_errors[self::file_info('error')];
        }
        elseif(!self::check_extension(Helper::isset_value('extension', $rules))){
            return "Extensão de arquivo invalida";
        }
        else{
            return false;
        }
    }

    public static function check_extension($accepted_extension = null){
        $accepted_extension = is_null($accepted_extension) ? FILES_ACCEPTED_EXTENSION : $accepted_extension;
        $accepted_extension = array_filter(explode("|", $accepted_extension));
        self::$file_info['extension'] = pathinfo(self::file_info('name'), PATHINFO_EXTENSION);
        return in_array(self::file_info('extension'), $accepted_extension);
    }

    public static function file_save($path, $new_name = null){
        $new_name = is_null($new_name) ? FILES_SHUFFLE_NAME : $new_name;
        $new_name = str_shuffle($new_name).'.'.self::file_info('extension');
        self::$file_info['new_name'] = $new_name;
        return move_uploaded_file(self::file_info('tmp_name'), $path.$new_name);
    }
}