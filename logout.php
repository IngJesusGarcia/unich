<?php
require('inc/comun.php');



if($_SESSION['c3valida']) {
	
	unset($_SESSION['c3valida']);
	
	if(isset($_COOKIE[session_name()]))	{
		setcookie(session_name(), "", time()-3600, "/");
	}
	
	$_SESSION = array();
	session_destroy();
	session_write_close();
	header ("Location: login.php");
}
?>