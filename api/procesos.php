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
		
		$query=$db->query("SELECT * FROM payments INNER JOIN user ON payments.id_user_id_payments=user.id_user INNER JOIN car ON payments.id_payments=car.id_payment_id_car INNER JOIN service ON car.id_service_car=service.id_service INNER JOIN accounts ON payments.id_accounts_id_payments=accounts.id_accounts where id_payments=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_service"],
							"nombre"=>$usuarios["name_service"],
							"cantida"=>$usuarios["cantidacar"],
							"tipo"=>$usuarios["tipo_producto"],
							"info"=>$usuarios["info_service"],
							"costo"=>$usuarios["costo_car"],
							"imagen"=>$usuarios["imagen"],
							"nombreuser"=>$usuarios["name_user"],
							"apellido"=>$usuarios["last_name_user"],
							"correo"=>$usuarios["mail_user"],
							"tel"=>$usuarios["phone_user"],
							"cuenta"=>$usuarios["tipe_accounts"],
							"bank"=>$usuarios["name_bank_accounts"],
							"numero"=>$usuarios["num_accounts"]

						
			);
		}
		echo json_encode($datos);
	}
}
?>