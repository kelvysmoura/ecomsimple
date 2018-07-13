<?php

namespace App\Controllers;

use \Core\Load as Ld;
use \Core\Input as Ipt;
use \Core\Helper as Hp;
use \Core\Session as Ss;

class Auth{
    
    private $user;
    
    public function __construct(){
        Ss::name(Hp::hash_session_name());
        Ss::start();
        Ss::regenerate();

        $this->user = Ld::model('user');
    }
    
    public function def(){
        if(Ipt::method('post')){

            $data = Ipt::post(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data = Hp::array_trim($data);
            if($user = $this->user->login($data['email'])){
                if(password_verify($data['password'], $user->password)){
                    Ss::exp(SESSION_EXP);
                    Ss::add('sub', $user->id);
                    Hp::redirect('dashboard');
                }
                else{
                    Hp::redirect('login?msg=Senha-incorreta');
                }
            }
            else{
                Hp::redirect('login?msg=Email-incorreto');
            }
        }
        else{
            Hp::redirect('login?e=Metodo-http-nao-aceito');
        }
    }

    public function logout(){
        Ss::destroy('sub');
        Ss::destroy('exp');
        Ss::reset();
        Ss::destroy();
        Hp::redirect('login?m=Logout');
    }

    
}