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
		$query=$db->query("update ingresos set ".$_POST["campo"]."='".$_POST["valor"]."' where id_ingreso='".intval($_POST["id"])."' limit 1");
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
		
		$query=$db->query("SELECT * FROM `salida` INNER JOIN service ON salida.id_service_id_salida=service.id_service INNER JOIN user ON salida.id_user_id_salida =user.id_user where id_salida=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_salida"],
							"nombre"=>$usuarios["name_service"],
							"cantida"=>$usuarios["cantida_salida"],
							"fecha"=>$usuarios["fecha_salida"],
							"proveedor"=>$usuarios["name_user"],
							"imagen"=>$usuarios["imagen"],
							"motivo"=>$usuarios["motivo_salida"]
							

							
						
			);
		}
		echo json_encode($datos);
	}
}
?>