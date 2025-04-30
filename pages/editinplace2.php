<?php


include '../inc/config.php';


$idu=$_GET['idu'];



if (isset($_POST) && count($_POST)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("update user set ".$_POST["campo"]."='".$_POST["valor"]."' where id_user='".intval($_POST["id"])."' limit 1");
		if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
		else echo "<span class='ko'>".$db->error."</span>";
	}
}

if (isset($_GET) && count($_GET)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{   
		// select * from editinplace order by idusuario asc
		
		$query=$db->query("SELECT * FROM user where id_user='".$idu."'");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_user"],
							"nombre"=>$usuarios["name_user"],
							"apellido"=>$usuarios["last_name_user"],
							"pw"=>$usuarios["pw_user"],
							"correo"=>$usuarios["mail_user"]
						
			);
		}
		echo json_encode($datos);
	}
}
?>