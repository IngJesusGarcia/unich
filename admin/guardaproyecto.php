<?php
include '../inc/config.php';
include '../inc/comun.php';

$bd = new GestarBD;

ob_clean();
header('Content-Type: application/json');

if (!isset($_GET['codigo'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Código del servicio no recibido.'
    ]);
    exit;
}

$x1 = $_GET['codigo'];
$response = [];

if (!isset($_FILES["imagenprin"])) {
    echo json_encode([
        'success' => false,
        'message' => 'No se envió ninguna imagen.'
    ]);
    exit;
}

$ver = "SELECT name_service, imagen FROM service WHERE id_service = $x1";
$bd->consulta($ver);
$a = $b = '';

while ($fila = $bd->mostrar_registros()) {
    $a = $fila->name_service;
    $b = $fila->imagen;
}

if ($a == "") {
    echo json_encode([
        'success' => false,
        'message' => 'Primero registra el título del proyecto en la pestaña datos básicos.'
    ]);
    exit;
}

$carpeta = ($b == "") ? "../../producto/" : "../producto/";

$file = $_FILES["imagenprin"];
$total = count($file["name"]);

for ($x = 0; $x < $total; $x++) {
    $nombre = $file["name"][$x];
    $tipo = $file["type"][$x];
    $ruta_provisional = $file["tmp_name"][$x];
    $size = $file["size"][$x];

    $dimensiones = @getimagesize($ruta_provisional);
    if ($dimensiones) {
        list($width, $height) = $dimensiones;
    } else {
        $width = $height = 0;
    }

    if (!in_array($tipo, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
        $response = [
            'success' => false,
            'message' => "Error $nombre: el archivo no es una imagen válida."
        ];
        break;
    }

    if ($size > 1024 * 1024) {
        $response = [
            'success' => false,
            'message' => "Error $nombre: el tamaño máximo permitido es 1MB."
        ];
        break;
    }

    $gale = "producto_";
    $name2 = $gale . $a . $nombre;
    $name3 = preg_replace('[\s+]', '', $name2);
    $src = $carpeta . $name3;

    if (move_uploaded_file($ruta_provisional, $src)) {
        $sql = "UPDATE `service` SET `imagen` = '$name3' WHERE `service`.`id_service` = $x1";
        $bd->consulta($sql);

        $response = [
            'success' => true,
            'message' => "Imagen actualizada con éxito.",
            'filename' => $name3,
            'width' => $width,
            'height' => $height
            
        ];
    } else {
        $response = [
            'success' => false,
            'message' => "Error al subir la imagen $nombre."
        ];
        break;
    }
}

echo json_encode($response);
exit;
?>
