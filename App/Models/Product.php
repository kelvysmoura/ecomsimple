<?php

namespace App\Models;

use \Core\DB;
use \Exception;

class Product extends DB{
    private $table = 'product';

    public function __construct(){
        parent::__construct();
    }

    public function all($fields = "*", $more = ''){
        try{
            $s = $this->query("SELECT {$fields} FROM {$this->table} {$more}");
            $s->execute();
            return $s->fetchAll();
        }
        catch(Exception $e){
            return false;
        }
    }
    public function all_where($where, $fields = "*", $more = ''){
        try{
            $more = !empty($where) ? "WHERE {$where[0]} ? ".$more : $more;
            $s = $this->prepare("SELECT {$fields} FROM {$this->table} {$more}");
            if(!empty($where)){
                $s->bindValue(1, $where[1]);
            }
            $s->execute();
            return $s->fetchAll();
        }
        catch(Exception $e){
            return $e->getMessage();
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

    public function new_product($data = []){
        try{
            $data['created_time'] = date('Y-m-d H:i:s');
            $fields = implode(',', array_keys($data));
            $pseudo = implode(',', array_fill(0, count($data), '?'));
            $i = $this->prepare("INSERT INTO {$this->table}({$fields}) VALUES({$pseudo})");
            foreach(array_values($data) as $k => $v){
                $i->bindValue(($k+1), $v);
            }
            $i->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function new_promotion($id, $data = []){
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
            $u->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function del($id){
        try{
            $d = $this->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $d->bindValue(1, $id);
            return $d->execute();
        }
        catch(Exception $e){
            return false;
        }

    }

}