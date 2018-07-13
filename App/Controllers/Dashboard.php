<?php

namespace App\Controllers;

use \Core\Load as Ld;
use \Core\Helper as Hp;
use \Core\Session as Ss;

class Dashboard{

    private $pHead = [];
    private $pNav = [];
    private $pFooter = [];
    private $pBody = [];

    public function __construct(){
        Ss::name(Hp::hash_session_name());
        Ss::start();
        if(Ss::get('sub')){
            if(Ss::check_exp()){
                Hp::redirect('login?msg=Sessão-expirou');
            }
        }
        else{
            Hp::redirect('login?msg=Faça-login');
        }

        $this->pFooter['js'] = array(
            Hp::main_url("assets/js/plugin.js"),
            Hp::main_url("assets/js/script.js"),
        );

        $this->pNav['menu'] = array(
            'home' => Hp::main_url('dashboard'),
            'new_product' => Hp::main_url('dashboard/new-product'),
            'view_product' => Hp::main_url('dashboard/view-product'),
            'new_promotion' => Hp::main_url('dashboard/new-promotion'),
            'my_account' => Hp::main_url('dashboard/my-account'),
            'logout' => Hp::main_url('auth/logout'),
        );
    }

    public function def(){
        $user = Ld::model('user');
        $user = $user->byId(Ss::get('sub'), 'first_name');

        $this->pHead['title'] = "Dashboard";
        $this->pBody['user_first_name'] = $user->first_name;
        
        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop', $this->pNav);
        Ld::view('dashboard/dashboard', $this->pBody);
        Ld::view('template/footer');
    }

     public function my_account(){
        $this_func = __FUNCTION__;
        $user = Ld::model('user');

        $this->pHead['title'] = "Minha conta | Dashboard";
        $this->pBody['user'] = $user->byId(Ss::get('sub'), 'first_name,last_name,email');
        $this->pBody['action_my_account'] = Hp::main_url("api/{$this_func}");
        $this->pFooter['js'][] = Hp::main_url("assets/js/{$this_func}.js");

        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop', $this->pNav);
        Ld::view("dashboard/{$this_func}", $this->pBody);
        Ld::view('template/footer', $this->pFooter);
    }

    public function new_product(){
        $this_func = __FUNCTION__;
        $this->pHead['title'] = "Criar Produto | Dashboard";
        $this->pFooter['js'][] = Hp::main_url("assets/js/{$this_func}.js");
        $this->pBody['action_new_product'] = Hp::main_url('api/product');

        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop', $this->pNav);
        Ld::view("dashboard/{$this_func}", $this->pBody);
        Ld::view('template/footer', $this->pFooter);
    }

    public function new_promotion(){
        $this_func = __FUNCTION__;
        $product = Ld::model('product');
        $product = $product->all('id,name,price', 'ORDER BY name asc');
        $product = array_map(function($p){
            $p->price = Hp::money_br($p->price);
            return "<option value='{$p->id}' data-price='".$p->price."'>{$p->name}</option>";
        }, $product);
        
        $this->pHead['title'] = "Criar Promoção | Dashboard";
        $this->pBody['product_option'] = implode('', $product);
        $this->pBody['action_new_promotion'] = Hp::main_url('api/promotion');
        $this->pFooter['js'][] = Hp::main_url("assets/js/{$this_func}.js");

        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop', $this->pNav);
        Ld::view("dashboard/{$this_func}", $this->pBody);
        Ld::view('template/footer', $this->pFooter);
    } 
    public function view_product(){
        $this_func = __FUNCTION__;
        $product = Ld::model('product');
        $all_products = $product->all('id,name,price,img,promotion_active,promotion_price,promotion_start,promotion_end', 'order by name asc');

        $this->pHead['title'] = "View Product | Dashboard";
        $this->pBody['products'] = $all_products;
        $this->pBody['product_del_url'] = Hp::main_url("api/product/");
        $this->pBody['product_link_url'] = Hp::main_url("store/product/");
        $this->pFooter['js'][] = Hp::main_url("assets/js/{$this_func}.js");

        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop', $this->pNav);
        Ld::view("dashboard/{$this_func}", $this->pBody);
        Ld::view('template/footer', $this->pFooter);
    }  
}