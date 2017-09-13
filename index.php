<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("Brazil/East");

require_once('_config.php');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Definiçoes
if($_SERVER['HTTP_HOST'] == 'localhost'){
    define("SERVIDOR", $config['SERVIDOR_LOCAL']);
    define("USUARIO", $config['USUARIO_LOCAL']);
    define("SENHA", $config['SENHA_LOCAL']);
    define("BANCO", $config['BANCO_LOCAL']);
} else {
    define("SERVIDOR", $config['SERVIDOR']);
    define("USUARIO", $config['USUARIO']);
    define("SENHA", $config['SENHA']);
    define("BANCO", $config['BANCO']);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Definiçoes de Pastas
if($_SERVER['HTTP_HOST'] == 'localhost'){
	$config_dominio = "http://".$_SERVER['HTTP_HOST']."/".$config['PASTA_LOCAL']."/";
} else {
    if($config['PASTA']){
	    $config_dominio = "http://".$_SERVER['HTTP_HOST']."/".$config['PASTA']."/"; 
	} else {
		$config_dominio = "http://".$_SERVER['HTTP_HOST']."/";
	}
}
define("DOMINIO", $config_dominio);
define("PASTA_CLIENTE", DOMINIO."sistema/arquivos/");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Outras Definições
define("COD_CLIENTE", '0');
define("AUTOR", "NuvemServ.com.br");
define("TOKEN", md5($config['TOKEN']) );
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SISTEMA
session_start();

define("CONTROLLERS", '_controllers/'); 
define("VIEWS", '_views/');
define("MODELS", '_models/');
define("LAYOUT", DOMINIO.VIEWS);

require_once('_system/system.php');
require_once('_system/mysql.php');
require_once('_system/controller.php');
require_once('_system/model.php');

//analytcs
$analytics = "analytics.txt";
$abre_analytics = fopen($analytics,"r+");
$conteudo_analytics = fread($abre_analytics, filesize($analytics));
define("analytics", $conteudo_analytics);
fclose($abre_analytics);

function __autoload( $arquivo ){
 	require_once(MODELS.$arquivo.".php");
}

$start = new system();
$start->run();