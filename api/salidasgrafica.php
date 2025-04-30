<?php
include("../conexion.php");

$sql = "SELECT fecha_salida, cantidad_salida FROM salida ORDER BY fecha_salida ASC";

$result = mysqli_query($con, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "fecha" => $row["fecha_salida"],
        "cantidad" => (int)$row["cantidad_salida"]
    ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
