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
		$query=$db->query("update service set ".$_POST["campo"]."='".$_POST["valor"]."' where id_service='".intval($_POST["id"])."' limit 1");
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
		
		$query=$db->query("SELECT * FROM service where id_service=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_service"],
							"nombre"=>$usuarios["name_service"],
							"precio"=>$usuarios["price_service"],
							"cantida"=>$usuarios["cantida"],
							"tipo"=>$usuarios["tipo_producto"],
							"info"=>$usuarios["info_service"],
							"costo"=>$usuarios["costo"],
							"imagen"=>$usuarios["imagen"]
						
			);
		}
		echo json_encode($datos);
	}
}
?>