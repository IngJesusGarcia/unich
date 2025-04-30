<?php
include("../conexion.php");

$sql = "SELECT name_service, cantida FROM service";
$result = mysqli_query($con, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "nombre" => $row["name_service"],
        "cantidad" => (int)$row["cantida"]
    ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
