<?php

namespace Core;

use \PDO;
use \PDOException;

class DB extends PDO{
    private $instance;

    public function __construct(){
        $dns = DRIVE.":host=".HOST.";port=".PORT.";dbname=".DBNAME;
        try{
            parent::__construct($dns, USERNAME, PASSWORD, array(
                PDO::ATTR_CASE => PDO::CASE_NATURAL,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        }
        catch(PDOException $e){
            var_dump($e);
            die();
        }
    }    
}
