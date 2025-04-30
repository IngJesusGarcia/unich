<?php 
//contraseña
$passs="VoYSg5Rbj8tf61CXgZml";
//nombre de base de datos 
$bd="bkpl3ehmvxx09o75gi2e";
//nombre de usuario 
$user="uopeepgpv9rwhrey";
//nombre de la empresa a la que le daras el servicio
$empresa="UNICH";

//Configuración general
$config = array(
	"titulo"=>"UNICH?",
	"subtitulo"=>"Inicio",
	"url"=>"http://{$_SERVER['HTTP_HOST']}/panel/", //Con / al final
	//"url" => "http://localhost/simpleCMS/",
	"charset"=>"utf-8",

	"friendlyurls"=>false,

	//Datos para la configuracion del envio de correo
	"emailadmin"=>"",
	"emailenvios"=>"",
	"nombreenvios"=>"UNICH?",
	"servidor"=>"bkpl3ehmvxx09o75gi2e-mysql.services.clever-cloud.com",
	"basedatos"=>"$bd",
	"usuario"=>"$user",
	"pass"=>"$passs",

	"googleanalytics"=>false,//Codigo UA- usado en las analiticas de Google
	"googlesiteverification"=>false,
	"mssiteverification"=>false
	); ?>

<?php
	$dbhost="bkpl3ehmvxx09o75gi2e-mysql.services.clever-cloud.com";
	$dbname="$bd";
	$dbuser="$user";
	$dbpass="$passs";
	$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	$mysqli_conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname); //connect to MySql
	if ($mysqli_conn->connect_error) {//Output any connection error
	    die('Error : ('. $mysqli_conn->connect_errno .') '. $mysqli_conn->connect_error);
	}
?>