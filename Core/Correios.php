<?php

namespace Core;

class Correios{
    
    const WS = 'http://ws.correios.com.br/calculador/';
    
    private static $end_point = 'CalcPrecoPrazo.aspx';

    private static $servico = [
        'SEDEX' => '04014',
        'PAC' => '04510'
    ];

    private static $query_url = [
        'nCdEmpresa' => '',
        'sDsSenha' => '',
        'nCdServico' => '', // SEDEX
        'sCepOrigem' => '',
        'sCepDestino' => '',
        'nVlPeso' => '1',
        'nCdFormato' => 1,
        'nVlComprimento' => 20.00,
        'nVlAltura' => 2.00,
        'nVlLargura' => 20.00,
        'nVlDiametro' => 0.00,
        'sCdMaoPropria' => 'n',
        'nVlValorDeclarado' => 0.00,
        'sCdAvisoRecebimento' => 'n',
        'StrRetorno' => 'xml',
        'nIndicaCalculo' => '3',
    ];

    public static function init($config = null){
        if(is_array($config)){
            self::$query_url = $config;
        }
        else{
            self::set_servico('sedex', 'pac');
        }
    }

    public static function set_servico(){
        $serv = self::$servico;
        $servicos = array_map(function($servico) use($serv){
            return $serv[strtoupper($servico)];
        },func_get_args());
        self::$query_url['nCdServico'] = (count($servicos) === 1) ? $servicos[0] : implode(',', $servicos);
    }

    public static function get_servico($codigo){
       return array_search($codigo, self::$servico);
    }

    public static function cep($origem, $destino){
        self::$query_url['sCepOrigem'] = $origem;
        self::$query_url['sCepDestino'] = $destino;
    }

    public static function preco($p){
        self::$query_url['nVlValorDeclarado'] = $p;
    }

    public static function getQueryUrl(){
        return self::$query_url;
    }

    public static function result(){
        self::$query_url = http_build_query(self::$query_url);
        self::$query_url = self::WS . self::$end_point . '?' . self::$query_url;
        return simplexml_load_file(self::getQueryUrl());
    }
}