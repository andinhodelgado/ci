﻿<?php
$maquina = null;
if(isset($_SERVER["COMPUTERNAME"])){
    $maquina = $_SERVER["COMPUTERNAME"];
}else{
    $maquina = getenv("COMPUTERNAME");
}

defined('COMPUTERNAME')
    || define('COMPUTERNAME', $maquina);
// Define conexão com o banco
if(COMPUTERNAME == "WNTVMIT"){
    defined('DB_USER')          || define('DB_USER', 'itdesk');
    defined('DB_PASS')          || define('DB_PASS', 'itdesk1553');
    defined('DB_USER_SYSTEM')   || define('DB_USER_SYSTEM', 'itdesk');
    defined('DB_PASS_SYSTEM')   || define('DB_PASS_SYSTEM', 'itdesk1553');
    defined('DB_NAME')          || define('DB_NAME', '//stafe-scan/stafe');
    $sistema = "/org";
}  else {
    defined('DB_USER')          || define('DB_USER', 'USINA2');
    defined('DB_PASS')          || define('DB_PASS', 'USINA2');
    defined('DB_USER_SYSTEM')   || define('DB_USER_SYSTEM', 'system');
    defined('DB_PASS_SYSTEM')   || define('DB_PASS_SYSTEM', 'onclick');
    defined('DB_NAME')          || define('DB_NAME', '//server.onclick1.imf.net.br/XE');
    $sistema = "/sistemas/org";
}

$porta   = "";
if($_SERVER['SERVER_NAME']== "dev.commit.inf.br" && !($_SERVER["SERVER_PORT"] == "80")){
        $sistema = "";            
        $porta   = ":".$_SERVER["SERVER_PORT"];
}
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define path para upload
defined('UPLOAD_PATH')
    || define('UPLOAD_PATH', realpath(dirname(__FILE__) . '/_upload/'));
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Define o nome do sistema
defined('PUBLIC_SISTEMA')
    || define('PUBLIC_SISTEMA', 'USINA');

// Define path to public directory
defined('PUBLIC_PATH')
    || define('PUBLIC_PATH', 'http://'. $_SERVER['SERVER_NAME'] . $porta .$sistema. '/public/');

//define o caminho do form
defined('FORM_PATH')
    || define('FORM_PATH', $sistema. '/');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();