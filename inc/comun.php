<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Va guardando toda la salida en una cache
ob_start();
include 'config.php';
include 'functionBD.php';
include 'resize.php';
//include 'functionForm.php';
//include 'functionTable.php';

// validacion de session
error_reporting( error_reporting() & ~E_NOTICE );
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$current_page = basename($_SERVER['PHP_SELF']);

if($current_page == 'login.php') {
	$redirect = false;
	
} else {
		
	if(!isset($_SESSION['c3valida']) || $_SESSION['c3valida'] !== true)	{
		die("ID de sesión inválido o no definido.");
		
   	} else {
		
		$redirect = false;
		
    	/*if(isset($_SESSION['tiempo'])) {
    		$vida_session = time() - $_SESSION['tiempo'];
			
        	if($vida_session > $config['inactivo']) {
            	$_SESSION = array();
				session_destroy();
				header ("Location: login.php?expirado=true");
        	}
    	}

    	$_SESSION['tiempo'] = time();*/
	}
}

if (!isset($_SESSION['c3valida']) || $_SESSION['c3valida'] !== true) {
    header("Location: login.php");
    exit("ID de sesión inválido o no definido.");
}

unset($redirect);