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
		
		$query=$db->query("SELECT * FROM movimientosaldo INNER JOIN saldo on movimientosaldo.id_msaldo_id_saldo=saldo.id_saldo INNER JOIN accounts ON saldo.id_saldo_id_accounts=accounts.id_accounts 
              INNER JOIN divisas ON saldo.id_divisa_id_saldo=divisas.id_divisas where id_msaldo=$idu");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["id_msaldo"],
							"nombre"=>$usuarios["name_bank_accounts"],
							"cantida"=>$usuarios["cantida_msaldo"],
							"fecha"=>$usuarios["fecha_msaldo"],
							"bank"=>$usuarios["tipo_mmovimiento"],
							"divisa"=>$usuarios["name_divisa"],
							"motivo"=>$usuarios["motivo_msaldo"]

							
						
			);
		}
		echo json_encode($datos);
	}
}
?>