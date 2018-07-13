<?php

namespace App\Controllers;

use \Core\Load as Ld;
use \Core\Helper as Hp;

class Store{
    private $pHead = [];
    private $pNav = [];
    private $pBody = [];
    private $pFooter = [];
    private $product;

    public function __construct(){
        $this->product = Ld::model('product');
        $this->pFooter['js'] = array(
            Hp::assets_url('js/plugin.js'),
            Hp::assets_url('js/script.js')
        );
        $this->pNav['menu'] = array(
            'home' => Hp::main_url(),
            'dashboard' => Hp::main_url('dashboard')
        );
    }

    public function def(){
        $all_products = $this->product->all('id,name,price,img,promotion_active,promotion_price,promotion_start,promotion_end', 'order by updated_time desc');
        $this->pHead['title'] = "Ecomsimple";
        $this->pBody['products'] = $all_products;
        $this->pFooter['js'][] = Hp::assets_url('js/store.js');
        Ld::view('template/head', $this->pHead);
        Ld::view('template/navtop_store', $this->pNav);
        Ld::view('store', $this->pBody);
        Ld::view('template/footer', $this->pFooter);
    }

    public function product($id = null){
        if(is_numeric($id)){
            $product = $this->product->byId($id,'id,name,price,img,description,promotion_active,promotion_price,promotion_start,promotion_end');
            $this->pHead['title'] = $product ? "{$product->name} | Ecomsimple" : "Ecomsimple";
            $this->pBody['product'] = $product;
            $this->pBody['action_finishi_buy'] = Hp::main_url('api/finish-buy');
            $this->pBody['action_api_frete'] = Hp::main_url('api/frete');
            $this->pFooter['js'][] = Hp::main_url('assets/js/product.js');
            Ld::view('template/head', $this->pHead);
            Ld::view('template/navtop_store', $this->pNav);
            Ld::view('product', $this->pBody);
            Ld::view('template/footer', $this->pFooter);
        }
        else{
            Hp::redirect();
        }
    }

}