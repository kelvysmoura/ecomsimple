<?php

namespace App\Models;

use \Core\DB;
use \Exception;

class User extends DB{
    
    private $table = 'user';

    public function __construct(){
        parent::__construct();
    }

    public function login($email){
        try{
            $s = $this->prepare("SELECT id, password FROM {$this->table} WHERE email = ?");
            $s->bindValue(1, strtolower($email));
            $s->execute();
            return ($s->rowCount() === 1) ? $s->fetch() : false;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function update($id, $data){
        try{
            $data['updated_time'] = date('Y-m-d H:i:s');
            $set = array_map(function($k){
                return $k."=?";
            }, array_keys($data));
            $set = implode(',', $set);
            $u = $this->prepare("UPDATE {$this->table} SET {$set} WHERE id = ?");
            foreach(array_values($data) as $k => $v){
                $u->bindValue(($k+1), $v);
            }
            $u->bindValue(count($data)+1, $id);
            return $u->execute();
        }
        catch(Exception $e){
            return false;
        }
    }

    public function byId($id, $fields = "*"){
        try{
            $s = $this->prepare("SELECT {$fields} FROM {$this->table} WHERE id = ?");
            $s->bindValue(1, $id);
            $s->execute();
            return $s->fetch();
        }
        catch(Exception $e){
            return false;
        }
    }
}