<?php 
if (isset($_GET['guarda'])) { 
  // Insertar nuevo registro (solicitud)
  $sql = "INSERT INTO `payments` (`id_payments`, `state_payment`, `date_payment`, `id_user_id_payments`) 
          VALUES (NULL, 'pendiente', '$hoy', '$idlog')";  
  $bd->consulta($sql);

  // Obtener el último ID registrado
  $consulta3 = "SELECT MAX(id_payments) as idpaymen FROM payments";
  $bd->consulta($consulta3);
  if ($fila3 = $bd->mostrar_registros()) { 
      $idpaymen = $fila3->idpaymen;      
  }

  // Insertar los productos desde el carrito
  if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
      foreach ($_SESSION["products"] as $product) { 
          $product_code = $product["id_service"];
          $cantidad = $product["product_qty"];

          $sql2 = "INSERT INTO `car` (`id_car`, `id_service_car`, `cantidacar`, `id_payment_id_car`) 
                   VALUES (NULL, $product_code, $cantidad, $idpaymen)";
          $bd->consulta($sql2);
      }

      // Limpiar carrito
      $_SESSION["products"] = null;
  }

  echo '<div class="alert alert-success alert-dismissable">
          <i class="fa fa-check"></i>
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <b>Bien!</b> Productos solicitados correctamente.
        </div>';
} 

?>


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase">
                Tus Solicitudes Sr(a) <b style="color: #2889b9"><?php echo $nombrelog; ?></b>
            </span>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th>Código de Solicitud</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $consulta = "SELECT * FROM payments WHERE id_user_id_payments=$idlog ORDER BY id_payments DESC";
                    $resultado = $bd->consulta($consulta); 
                    if ($bd->numeroFilas() > 0) { 
                        $bd->consulta($consulta);
                        while ($fila = $bd->mostrar_registros()) { 
                            $id = $fila->id_payments;
                            $estado = $fila->state_payment;
                            $fecha = $fila->date_payment;
                ?>  
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $fecha; ?></td>
                    <td>
                        <?php 
                            if ($estado == "proceso") {
                                echo "<p style='color: orange'>Procesando</p>";
                            } elseif ($estado == "aceptado") {
                                echo "<p style='color: green'>Aceptado</p>";
                            } else {
                                echo "<p style='color: red'>Pendiente</p>";
                            }
                        ?>
                    </td>
                    <td>
                        <a class="btn red btn-outline sbold" data-toggle="modal" href="#factura<?php echo $id; ?>">Ver Detalles</a>
                    </td>
                </tr>

                <!-- Modal de Detalle -->
                <div class="modal fade" id="factura<?php echo $id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Detalle de Solicitud N° <?php echo $id; ?></h4>
                            </div>
                            <div class="modal-body">
                                <h4>Servicio <span style="float:right;">Cantidad</span></h4>
                                <hr>
                                <?php 
                                    $consulta2 = "SELECT service.name_service, car.cantidacar 
                                                  FROM car 
                                                  INNER JOIN service ON car.id_service_car = service.id_service 
                                                  WHERE id_payment_id_car = $id";
                                    $base = new GestarBD();
                                    $base->consulta($consulta2);
                                    while ($fila2 = $base->mostrar_registros()) { 
                                ?>
                                    <p>
                                        <?php echo $fila2->name_service; ?>
                                        <span style="float:right;"><?php echo $fila2->cantidacar; ?></span>
                                    </p>
                                <?php } ?>
                                <hr>
                                <p><strong>Estado:</strong> 
                                    <?php 
                                        if ($estado == "proceso") {
                                            echo "<span style='color: orange'>Procesando</span>";
                                        } elseif ($estado == "aceptado") {
                                            echo "<span style='color: green'>Aceptado</span>";
                                        } else {
                                            echo "<span style='color: red'>Pendiente</span>";
                                        }
                                    ?>
                                </p>
                                <p><strong>Fecha de Solicitud:</strong> <?php echo $fecha; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                        } // while
                    } // if
                ?> 
            </tbody>
        </table>
    </div>
</div>
