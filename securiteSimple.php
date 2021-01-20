<?php
	$base=connectBase() ;
	define('APPLICATION_NAME' , 'Demo Securite') ;
	define('TEXT_TRY', 'Veuillez vous identifier' ) ;
	define('TEXT_FAIL', 'Identifiants incorrects' ) ;
	if(!isset($_SERVER['PHP_AUTH_USER'])){
		header('WWW-Authenticate: Basic realm="'.APPLICATION_NAME. '"');
		header('HTTP/1.0 401 Unauthorized');
		echo TEXT_TRY;
		exit;
	}
	$user=$_SERVER['PHP_AUTH_USER'];
	$pass=$_SERVER['PHP_AUTH_PW'];
	if(checkUserPass($base, $user, $pass)!=1){
		header('WWW-Authentificate: Basic realm="'.APPLICATION_NAME.'"');
		header('HTTP/1.0 401 Unauthorized');
		echo TEXT_FAIL;
		exit;
	}
?>