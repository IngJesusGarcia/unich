<?php
include '../inc/config.php';
include '../inc/comun.php';

$bd = new GestarBD;

header('Content-Type: application/json');

$query = "SELECT NOW() as valorx, SUM(cantida_salida) as valory FROM salida";
$bd->consulta($query);
$data = [];

while ($row = $bd->mostrar_registros()) {
    $data[] = [
        'valorx' => $row->valorx,
        'valory' => $row->valory
    ];
}

echo json_encode($data);
