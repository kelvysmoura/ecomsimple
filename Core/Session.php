<?php

namespace Core;

class Session {

    public static function id($id = null){
       return is_null($id) ? session_id() : session_id($id);
    }
    
    public static function name($n = null){
       return is_null($n) ? session_name() : session_name($n);
    }

    public static function status(){
        return session_status();
    }

    public static function start($verify_active = true){
        if($verify_active && self::status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        else{
            session_start();
        }
    }

    public static function regenerate(){
        session_regenerate_id();
    }
    
    public static function reset(){
        return session_reset();
    }
    

    public static function add($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key = null){
        return is_null($key) ? $_SESSION : (isset($_SESSION[$key]) ? $_SESSION[$key] : false);
    }

    public static function exp($seconds = null){
        if(self::status() === PHP_SESSION_ACTIVE){
            $seconds = is_null($seconds) ? 1800 : $seconds;
            self::add('exp', time()+$seconds);
        }
    }

    public static function check_exp(){
        if(self::get('exp') && self::get('exp') >= time()){
            self::exp(SESSION_EXP);
            return false;
        }
        else{
            return true;
        }
    }


    public static function destroy($item = null){
        if(is_null($item)){
            return session_destroy();
        }
        else{
            unset($_SESSION[$item]);
        }
    }
}