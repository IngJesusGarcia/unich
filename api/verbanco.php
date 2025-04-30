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
		$query=$db->query("update accounts set ".$_POST["campo"]."='".$_POST["valor"]."' where id_accounts='".intval($_POST["id"])."' limit 1");
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
		
		$query=$db->query("SELECT * FROM accounts where id_accounts=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_accounts"],
							"nombre"=>$usuarios["name_bank_accounts"],
							"tipo"=>$usuarios["tipe_accounts"],
							"propietario"=>$usuarios["name_accounts"],
							"num"=>$usuarios["num_accounts"],
							"email"=>$usuarios["mail_accounts"],
							"ci"=>$usuarios["ci_accounts"]
						
			);
		}
		echo json_encode($datos);
	}
}
?>