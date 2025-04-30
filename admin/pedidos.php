  

<script LANGUAGE="JavaScript">
function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea eliminar este Empleado?"))
    window.location.href = url;
else
    return false ;
}
</script>

<?php



$fecha_actual = date ("Y-m-d"); 
$hora = date("H:i:s",time()-3600);
if (isset($_GET['eliminar'])) { 
     $ci=$_GET["cod"]; 
 //datos que vienen del formulario             
if( $ci ==""){
echo "";
}else{
  
$ip="{$_SERVER['REMOTE_ADDR']}";
$puerto="{$_SERVER['REMOTE_PORT']}"; 

$sql="INSERT INTO `bitacora` ( `fecha_movimientos`, `hora_movimiento`, `ip_ordenador`, `descripcion`, `usuarios_cedula`,`tipo`) VALUES ( '$fecha_actual', '$hora', '$ip', 'Se Elimino un  empleado con el n cedula ".$ci." ', '$adminci', '2');";
$bd->consulta($sql);


                         
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Eliminados Correctamente... ';

                               echo '   </div>';

?>
 <?php    
}
}

if (isset($_GET['aprobar'])) {
    $id_aprobar = $_GET['aprobar'];
    
    if (!empty($id_aprobar)) {
        $fecha_aprobacion = date("Y-m-d H:i:s");

        $sql_aprobar = "UPDATE payments 
                        SET state_payment = 'aceptado', 
                            date_pago = '$fecha_aprobacion' 
                        WHERE id_payments = '$id_aprobar'";
        $bd->consulta($sql_aprobar);

        echo '<div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Listo!</b> Pedido aprobado correctamente y se registró la fecha.
              </div>';
    }
}


        if (isset($_GET['eliminar'])) { 

                 $x1=$_GET["codigo"];                    
                if( $x1=="" ){
                    echo "<script> alert('campos vacios')</script>";
                    echo "<br>";
                }else{
                                $sql3="delete from `payments` where `payments`.`id_payments`='".$x1."'";
                                $bd->consulta($sql3);
                               

                   
                                            //echo "Datos Guardados Correctamente";
                                            echo '<div class="alert alert-success alert-dismissable">
                                                        <i class="fa fa-check"></i>
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Bien!</b> Se Elimino Correctamente... </div>';
                    }
        }


                if (isset($_GET['crear'])) { 

                          $service = utf8_decode($_POST['service']);
                          $cantida = utf8_decode($_POST['cantida']);
                          $fecha = utf8_decode($_POST['fecha']);
                          $user = utf8_decode($_POST['user']);
                          $motivo = utf8_decode($_POST['motivo']);
                          $cuenta =  utf8_decode($_POST['cuenta']);


                        $resultado = str_replace("T", " ", $fecha);

                        if($fecha==""){
                          $resultado= $hoy = date("Y-m-d H:m:s");
                         }


                                 if( $service==""  ){

                                    echo "
                   <script> alert('campos vacios')</script>
                   ";
                                    echo "<br>";
                                }else{
                                  
                                  //consultamos si existe

                                         $consulta="SELECT * FROM `service` where id_service='$service'";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { 
                                           $totalactual= $fila->cantida; 
                                           $costoactual= $fila->costo; 
                                           $precioactual= $fila->price_service; 
                                          }
                                          if($costo=="")
                                            $costo=$costoactual;

                                          if($salida=="")
                                            $salida=$precioactual;
                                                  //suma de cantidad actual mas la nueva
                                                   $grantotal=$totalactual-$cantida;

                                                  $editar="UPDATE `service` SET `cantida` = '$grantotal',`price_service` = '$salida',`costo` = '$costo' WHERE `service`.`id_service` = '$service'";
                                                  $bd->consulta($editar);
                    

                                             $sql="INSERT INTO `salida` (`id_salida`, `id_service_id_salida`, `fecha_salida`, `id_user_id_salida`, `cantida_salida`, `motivo_salida`,`id_salida_id_accounts`) VALUES (NULL, '$service', '$resultado', '$user', '$cantida', '$motivo','$cuenta')";
                                              $bd->consulta($sql);

                                                        //echo "Datos Guardados Correctamente";
                                                        echo '<div class="alert alert-success alert-dismissable">
                                                                    <i class="fa fa-check"></i>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <b>Bien!</b> Datos Registrados Correctamente... ';
                                                           echo '   </div>';
                                  
    }
}
?>




                    <div class="row">
                        <div class="col-md-12">
                     
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=pedidos"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-arrow-up font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista de pedidos Pendientes </span>
                                       
                                    </div>

                                    <div class="tools "> </div>
                                    
                                </div>

                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th  class="all hidden-print">#</th>
                                                <th class="min-phone-l">Estado de Pedido</th>
                                                <th class="min-phone-l">Fecha</th>
                                                <th class="min-phone-l">Nombre Cliente </th>
                                                
                                                <th class="none">Nombre del Producto</th>
                                                
                                                <th class="none">Cantida</th>
                                                <th class="none">Datos Del Producto</th>
                                                <th  class="min-phone-l hidden-print noimprimir"> Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM payments INNER JOIN user ON payments.id_user_id_payments=user.id_user INNER JOIN car ON payments.id_payments=car.id_payment_id_car INNER JOIN service ON car.id_service_car=service.id_service where state_payment='pendiente'  ";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_payments;
                                        $p=$fila->state_payment; 
                                        ?>


                                             <td  width="5%"><?php echo $fila->id_payments; ?></td>
                                              <?php
                                      if($p=="proceso"){
                                        echo "<td width='25%' style='color: orange'> Procesando </td>";
                                        }elseif ($p=="pagada") {
                                            echo "<td width='25%' style='color: green'> Procesando </td>";
                                            # code...
                                        }elseif($p=="pendiente"){
                                             echo "<td width='25%' style='color: red'> Pendiente</td>";
                                        }else{
                                              echo "<td  width='25%' style='color: red'> Pendiente</td>";
                                        }
                                         ?>                                  
                                             <td  width="20%"><?php echo $fila->date_payment; ?></td>
                                             <td  width="20%"><?php echo $fila->name_user; ?>  </td>
                                             
                                             <td><?php echo $fila->name_service; ?></td>
                                           
                                             <td><?php echo $fila->cantidacar; ?></td>
                                              <td><?php echo $fila->info_service; ?></td>
                                             
                                              <td width="20" class="hidden-print noprin">
                                                <center>
                                                  <a  class="btn red btn-outline sbold"  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold"  href='?admin=pedidos&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>

                                                  <?php if($p == "pendiente"): ?>
      <a class="btn green btn-outline sbold" title="Aprobar Pedido" href='?admin=pedidos&aprobar=<?php echo $id ?>' onclick="return confirm('¿Deseas aprobar este pedido?');">
        <i class="fa fa-check"></i>
      </a>
    <?php endif; ?>
                                                </center> 
                                             </td>
                                        </tr>

            


                                          <?php 
                                           }
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
               

      <script>
          var variableGlobal;
           
          function myFunction(elmnt,clr) { 
           variableGlobal = clr;
              var idd = clr;
              console.log(variableGlobal);
               $.ajax({
                      type: "GET",
                      url: "api/salidas.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                      "<div class='col-xs-8'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>"+json[i].id+"</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Producto o servicio:</span> <span  data-campo='name_service' style='font-size: 9pt; text-align: left;'>"+json[i].nombre+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantidad:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida_salida' >"+json[i].cantida+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Fecha:</span> <span style='font-size: 9pt; text-align: left;' data-campo='fecha_salida' >"+json[i].fecha+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cliente:&nbsp; </span><span data-campo='name_user' >"+json[i].proveedor+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Motivo:&nbsp; </span><span data-campo='motivo_salida' >"+json[i].motivo+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Motivo:&nbsp; </span><span data-campo='name_bank_accounts' >"+json[i].bank+"</span></li></ul></div><div class='col-xs-4'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'></div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/"+json[i].imagen+"'></span></br></div></div>");
                              }

                      });
          }
      </script>
      
      <?php 
     
      ?>
        
<!--modal guardar nuevo -->
       
                           
             

        <!--modal editar -->
      
        <!--modal editar -->
        
  <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
</div>
