<?php
namespace Core;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class Mailer extends PHPMailer{

    private $username_label = MAILER_USERNAME_LABEL;

    public function __construct($credentials = []){
        parent::__construct(true);
        $this->SMTPDebug = MAILER_DEBUG;
        $this->CharSet = MAILER_CHARSET;
        $this->isSMTP();
        $this->Host = MAILER_HOST;
        $this->SMTPAuth = true;
        $this->Username = Helper::isset_value('username', $credentials, MAILER_USERNAME);
        $this->Password = Helper::isset_value('password', $credentials, MAILER_PASSWORD);
        $this->SMTPSecure = MAILER_SECURE;
        $this->Port = MAILER_PORT;
    }

    public function username_label($label = null){
        $this->username_label = is_null($label) ? MAILER_USERNAME_LABEL : $label;
    }
    public function recipient($email, $name = null){
        $this->addAddress($email, $name);
    }
    public function content_subject($subject = 'Assunto'){
        $this->Subject = $subject;
    }
    public function body_html($content = '<h1>Conteúdo em html</h1>'){
        $this->isHTML(true);
        $this->Body = $content;
    }
    public function body_alt($content = "Conteúdo sem html"){
        $this->AltBody = $content;
    }
    public function execute(){
        $this->setFrom($this->Username, $this->username_label);
        try{
            return $this->send();
        } catch (Exception $e) {
            // return 'Message could not be sent. Mailer Error: '.$this->ErrorInfo;
            return false;
        }
    }


}