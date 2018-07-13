<?php
/**
 * DOMINIO COMPLETO DO SITE
 */
define('MAIN_URL', '');

/**
 * CONTROLLER QUE VAI SER CHAMANDO QUANDO NENHUM CONTROLLER FOR DEFINIDO
 */
define('MAIN_CONTROLLER', 'Store');

/**
 * TRUE = MOSTRAR TODOS OS ERROS
 * FALSE = ESCONDER TODOS OS ERROS;
 */
define('DEVELOPMENT', TRUE);

/**
 * CONSTANTES DE DIRETORIOS
*/
define('DS', DIRECTORY_SEPARATOR);
define('PARENT_DIR', '..'.DS);
define('CORE_PATH', ROOT_SITE.'Core'.DS);
define('APP_PATH', ROOT_SITE.'App'.DS);
define('CONTROLLERS_PATH', APP_PATH.'Controllers'.DS);
define('VIEWS_PATH', APP_PATH.'Views'.DS);
define('MODELS_PATH', APP_PATH.'Models'.DS);
define('VENDOR_PATH', ROOT_SITE.'vendor'.DS);
define('ASSETS_PATH', ROOT_SITE.'assets'.DS);

/**
 * CONSTANTES DE BANCO DE DADOS
 */
define('DRIVE', 'mysql');
define('HOST', '');
define('PORT', '');
define('DBNAME', '');
define('USERNAME', '');
DEFINE('PASSWORD', '');

/**
 * CONSTANTE USADA PARA INFORMAR O CEP DE DESTINO NA API DOS CORREIOS
 */
define('CEP_ORIGIN', '20081902');

/**
 * CONSTANTE QUE DEFINE O TEMPO EM A SESSÃO EXPIRA
 * SE FOR DEFINIDA COMO NULL A SESSÃO EXPIRA NO VALOR PADRÃO DE 1800 SEGUNDOS
 * Obs: essa funcionalidade não utiliza session_cache_expire() e sim uma função personalizada para exipirar a sessão
*/
define("SESSION_EXP", null);

/**
 * CONSTANTE QUE DEFINE OS TIPOS DE ARQUIVOS ACEITOS
 */
define("FILES_ACCEPTED_EXTENSION", 'jpg|png');

/**
 * CONSTANTE BASE PARA O NOVO NOME DO ARQUIVO
 * Obs: o conteudo dessa constant vai ser "embaralhada" pela função php str_suffle
 */
define("FILES_SHUFFLE_NAME", 'product_ecomsimple-'.time());

/**
 * CONSTANTES DE CONFIGURAÇÃO PARA ALGUMAS PROPRIEDADE DO PHPMAILER SETADA NA CLASS MAILER DO DIRETORIO CORE
*/
define('MAILER_DEBUG', 0);
define('MAILER_CHARSET', 'UTF-8');
define('MAILER_USERNAME_LABEL', 'Ecomsimple');
define('MAILER_USERNAME', 'seu-email');
define('MAILER_PASSWORD', 'sua-senha');
define('MAILER_HOST', 'smtp.googlemail.com');
define('MAILER_SECURE', 'tls');
define('MAILER_PORT', 25);

/**
 * LINKS DE CDNs JS
*/
define("CDN_JQUERY", 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
define("CDN_JQUERY_VALIDATE", 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js');
define("CDN_JQUERY_MASK", 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js');
define("CDN_UIKIT_JS", 'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js');
define('CDN_UIKIT_ICON_JS', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js');
