<?php

namespace App\Controllers;

use \Core\Load as Ld;
use \Core\Helper as Hp;

class Login{
    
    private $pHead = [];
    private $pBody = [];

    public function __construct(){
        
    }
    
    public function def(){
        $this->pHead['title'] = "Login";

        Ld::view('template/head', $this->pHead);
        Ld::view('login');
        Ld::view('template/footer');
    }

}