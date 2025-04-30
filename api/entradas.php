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
		
		$query=$db->query("SELECT * FROM `ingresos` INNER JOIN service ON ingresos.id_service_id_ingreso=service.id_service INNER JOIN proveedor ON ingresos.id_proveedor_id_ingreso=proveedor.id_proveedor where id_ingreso=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_ingreso"],
							"nombre"=>$usuarios["name_service"],
							"cantida"=>$usuarios["cantida_movimiento"],
							"fecha"=>$usuarios["fecha_ingreso"],
							"proveedor"=>$usuarios["nombre_proveedor"],
							"imagen"=>$usuarios["imagen"],
							"motivo"=>$usuarios["motivo"]

							
						
			);
		}
		echo json_encode($datos);
	}
}
?>