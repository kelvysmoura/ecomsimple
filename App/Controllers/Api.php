<?php
namespace App\Controllers;
use \Core\Helper as Hp;
use \Core\Session as Ss;
use \Core\Input as Ipt;
use \Core\Output as Out;
use \Core\Upload as Upl;
use \Core\Load as Ld;
use \Core\Correios;
use \Core\Mailer;
use \Core\Http;

class Api{
    private $product;
    public function __construct(){
        Out::content_type('application/json');
        $this->product = Ld::model('product');
    }

    public function my_account(){
        $this->check_session();
        if(Ipt::method('post')){
            $user = Ld::model('user');
            $user = $user->update(Ss::get('sub'), Ipt::post());
            if($user){
                Http::response('Atualizado com sucesso');
            }
            Http::response('Falha ao tentar atualizar', 400);
        }
    }

    public function product($id = null, $img = null){
        $this->check_session();
        if(Ipt::method('post')){
            Upl::init('img');
            if($check_file = Upl::check()){
                Http::response($check_file, 400);
            }
            if(!Upl::file_save(ASSETS_PATH."img".DS)){
                Http::response('Falha ao tentar fazer upload do arquivo', 400);
            }
            $data['price'] = Hp::money_db(Ipt::post('price'));
            $data['name'] = Ipt::post('name');
            $data['description'] = Ipt::post('description');
            $data['img'] = Upl::file_info('new_name');
            if($this->product->new_product($data)){
                Http::response('Produto cadastrado com sucesso');
            }else{
                Http::response('Falha ao cadastrar produto', 400);
            }
        }
        elseif(Ipt::method('delete')){
            if(!is_null($id)){
                sleep(1);
                if($del = $this->product->del($id)){
                    if(file_exists(ASSETS_PATH . "img/{$img}")){
                        unlink(ASSETS_PATH . "img/{$img}");
                    }
                    Http::response('Produto excluido!');
                }
                else{
                    Http::response('Não foi possivel excluir este produto!', 400);
                }
            }
        }
        else{
            Http::response('Método de requisição invalido');
        }
    }

    public function promotion(){
        $this->check_session();
        if(Ipt::method('post')){
            $pstart = Hp::date_db(Ipt::post('date_start'))." ".Ipt::post('hour_start');
            $pend = Hp::date_db(Ipt::post('date_end'))." ".Ipt::post('hour_end');
            $data = array(
                'promotion_active' => true,
                'promotion_start' => $pstart,
                'promotion_end' => $pend,
                'promotion_price' => Hp::money_db(Ipt::post('price'))
            );
            if($this->product->new_promotion(Ipt::post('product'), $data)){
                Http::response('Promoção criada com sucesso');
            }else{
                Http::response('Falha ao tentar criar promoção');
            }
        }
        else{
            Http::response('Método de requisição invalido');
        }
    }

    public function frete($cep){
        if(!is_null($cep)){
            Correios::init();
            Correios::cep(CEP_ORIGIN, $cep);
            Correios::preco((float)Hp::money_db(Ipt::post('product_price')));
            $result = Correios::result();
            $data_correios = [];
            foreach($result as $v){
                $v = (array)$v;
                $data_correios[] = array_merge(
                    array('ServicoName' => Correios::get_servico($v['Codigo'])), 
                    array('Codigo' => $v['Codigo'], 'Valor' => $v['Valor'], 'PrazoEntrega' => $v['PrazoEntrega'])
                );
            }
            Http::response($data_correios);
        }
    }
    
    public function finish_buy(){
        if(Ipt::method('post')){
            $data = Ipt::post();
            $price_total = Hp::money_db($data['product_price'])+Hp::money_db($data['frete_price']);
            $price_total = Hp::money_br($price_total);
            $product_link = Ipt::server('http_referer');
            $body_html = "
                <h2><a href='{$product_link}'>Visualizar produto</a></h2>
                <h3>Informações do comprador</h3>
                <ul>
                    <li><strong>Nome do comprador:</strong> {$data['cli_name']}</li><br>
                    <li><strong>Email do comprador:</strong> {$data['cli_email']}</li><br>
                </ul>

                <h3>Informações do produto</h3>
                <ul>
                    <li><strong>Valor do produo:</strong> R$ {$data['product_price']}</li><br>
                    <li><strong>Tipo do frete:</strong> {$data['frete_type']}</li><br>
                    <li><strong>Valor do frete:</strong> R$ {$data['frete_price']}</li><br>
                    <li><strong>Prazo de entrega:</strong> {$data['frete_time']} dias úteis</li><br>
                    <li><strong>Valor total:</strong> R$ {$price_total}</li>
                </ul>
            ";
            $mail = new Mailer();
            $mail->recipient($data['cli_email'], $data['cli_name']);
            $mail->content_subject($data['product_name']);
            $mail->body_html($body_html);
            if($e = $mail->execute()){
                Http::response('Verifique sua caixa de email');
                // Http::response($e);
            }
            else{
                Http::response('Error ao finalizar a comprar. Entre em contato com o desenvolvedor', 400);
            }
        }
    }

    private function check_session(){
        Ss::name(Hp::hash_session_name());
        Ss::start();
        if(Ss::get('sub')){
            if(Ss::check_exp()){
                Http::response('Sessão expirou <a href="'.Hp::main_url('login').'">Fazer login</a>', 401);
            }
        }
        else{
           Http::response('Acesso negado', 401);
        }
    }
}