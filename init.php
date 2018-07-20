<?php
/***********************************************************************
  Copyright (C) Keos Media
************************************************************************/

//header("Content-Type: text/html; charset=utf-8", true);

if ( get_magic_quotes_gpc() ) {
    function stripslashes_gpc(&$value) { $value = stripslashes($value); }
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
	array_walk_recursive($_PUT, 'stripslashes_gpc');
	array_walk_recursive($_DELETE, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}

/*
 * 	DEBUG  - admin option
*/

define('DEBUG',1);

/*
 * 	CONSTANTS
*/
$root = dirname(__FILE__);
define('DS', 		DIRECTORY_SEPARATOR);


if($_SERVER['HTTP_HOST'] == 'rejestracja.b2bon.pl' or $_SERVER['HTTP_HOST'] == 'www.rejestracja.b2bon.pl'){
	define('APP',  DS .'app'. DS .'register'. DS);	
}
else if($_SERVER['HTTP_HOST'] == 'api.b2bon.pl' or $_SERVER['HTTP_HOST'] == 'www.api.b2bon.pl'){
	define('APP',  DS .'app'. DS .'admin'. DS);	
}
else 
define('APP',  DS .'app'. DS .'admin'. DS);	

define('PARENT_DIRECTORY', 	'..');
define('ROOT', 		$root);
define('CACHE', 	$root . APP . 'cache');
define('MODULE', 	$root . APP . 'modules');
define('MODULE_CONTROLLER', 'controller');
define('LIB', 		$root . DS . 'lib');
define('TOOL', 		$root . DS . 'tool');

if($_SERVER['HTTP_HOST'] == 'demo.b2bon.pl' or $_SERVER['HTTP_HOST'] == 'www.demo.b2bon.pl')
	require_once(ROOT . APP . 'demo_config.php');
else
	require_once(ROOT . APP . 'config.php');

define('SRC', 		URL);
define('AJAX', 		URL . DS . 'tool' . DS . 'Ajax.php');
define('API', 		URL . DS . 'tool' . DS . 'Api.php');
define('AJAX_UPLOAD', 		URL . DS . 'tool' . DS . 'AjaxUpload.php');
define('TEMP', 		'temp');
define('UPLOAD_TEMP_PATH', 	$root. APP . TEMP . DS);
define('UPLOAD_SESID',	'a@1f3aa07_ha^da4asDWrs*a@cP');


define('AllOW_DUPE_EMAIL','0'); 			//0 - deny, 1 - allow
define('SIMPLE_LOGIN_LIMIT',4);         //limit for simple login 
define('LOGIN_CONFIRMATIONS_LIMIT',2);  //limit for confirmations to login
define('DEFAULT_USER_GROUP',5); 		//default group for register user


//define('SESSION_LIFETIME', (int)ini_get('session.gc_maxlifetime'));

/*
 * 	AUTOLOADER
*/

spl_autoload_register(function ($class) {
	//error_reporting(E_ALL ^ E_NOTICE);
	//ini_set('display_errors', 1);

	$file = $class . '.php';
	
	$lib 	= LIB . DS . $file;
	$tool 	= TOOL . DS . $file;
	$model 	= MODULE . DS . $class . DS .'model'. DS . $file;
	$root 	= ROOT . DS . $file;
	
	if 		( file_exists($lib) ) require_once($lib);
	if 		( file_exists($tool) ) require_once($tool);
	if 		( file_exists($model) ) require_once($model);
	elseif 	( file_exists($root) ) require_once($root);
	else 	return false;
});

