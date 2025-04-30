

<script LANGUAGE="JavaScript">
function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea eliminar este Empleado?"))
    window.location.href = url;
else
    return false ;
}

function confirmDela(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea Aprovar esta Venta?"))
    window.location.href = url;
else
    return false ;
}
</script>

<?php

$fecha_actual = date ("Y-m-d"); 
$hora = date("H:i:s",time()-3600);
  
        if (isset($_GET['eliminar'])) { 

                 $x1=$_GET["codigo"];                    
                if( $x1=="" ){
                    echo "<script> alert('campos vacios')</script>";
                    echo "<br>";
                }else{          
                  $sql4="delete from `car` where `car`.`id_payment_id_car`='".$x1."'";
                                $bd->consulta($sql4);
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
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=procesando"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-arrow-up font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista de pedidos Pendientes de revisión</span>
                                       
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
                                                <th  class="min-phone-l hidden-print noimprimir"> Opciones</th>
                                                <th class="none">Nombre del Producto</th>
                                                <th class="none">Costo</th>
                                                <th class="none">Cantida</th>
                                                <th class="none">Plataforma de Pago Usada</th>
                                                <th class="none">Datos Del Producto</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
$consulta = "SELECT * FROM payments 
    INNER JOIN user ON payments.id_user_id_payments=user.id_user 
    INNER JOIN car ON payments.id_payments=car.id_payment_id_car 
    INNER JOIN service ON car.id_service_car=service.id_service 
    WHERE payments.state_payment != 'pendiente'";
$bd->consulta($consulta);
while ($fila = $bd->mostrar_registros()) {
    $id = $fila->id_payments;
    $p = $fila->state_payment;
?>
                                             <td  width="5%"><?php echo $fila->id_payments; ?></td>
                                             
                                       <?php
                                       if ($p == "proceso") {
                                           echo "<td width='25%' style='color: orange'> Procesando </td>";
                                       } elseif ($p == "pagada") {
                                           echo "<td width='25%' style='color: green'> Pagada </td>";
                                       } else {
                                           echo "<td width='25%' style='color: green'> Aprobado </td>";
                                       }
                                       ?>
                                                                       
                                             <td  width="25%"><?php echo $fila->date_payment; ?></td>
                                             <td  width="20%"><?php echo $fila->name_user; ?>  </td>
                                             <td width="25%" class="hidden-print noprin">
                                                <center>
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productover"   title="ver" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" ><i class='fa fa-eye'></i></a>
                                                 
                                                  
                                             <a  class="btn red btn-outline sbold derecha"  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold" href="?admin=procesando&eliminar&codigo=<?php echo $id ?>" ><i class=' fa fa-trash'></i></a>
                                                </center> 
                                             </td>
                                             <td><?php echo $fila->name_service; ?></td>
                                             <td><?php echo $fila->costo_car; ?></td>
                                             <td><?php echo $fila->cantidacar; ?></td>
                                             <td><?php echo $fila->name_bank_accounts; ?></td>
                                             <td><?php echo $fila->info_service; ?></td>
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
                      url: "api/procesos.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                     "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 '><center><span class='label label-primary'data-campo='tipo_producto' >Datos del Producto</center></span><div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'> <ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>"+json[i].id+"</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Nombre:</span> <span  data-campo='name_service' style='font-size: 9pt; text-align: left;'>"+json[i].nombre+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Costo:</span>  <span style='font-size: 9pt; text-align: left;' data-campo='costo' >"+json[i].costo+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantida:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida' >"+json[i].cantida+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de Producto:&nbsp; </span><span data-campo='tipo_producto' >"+json[i].tipo+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Descripción:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='info_service' >"+json[i].info+"</span></li></div><div class='col-xs-6'><div><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'>Producto</div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><center><img width='60%' src='./producto/"+json[i].imagen+"'></center></span></div></div><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'><div style='margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;'></div><div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'><center><a><span class='label label-primary'data-campo='tipo_producto' >Datos del Cliente</span></a></center><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cliente:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='name_user' >"+json[i].nombreuser+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Apellido:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='last_name_user' >"+json[i].apellido+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Email:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='mail_user' >"+json[i].correo+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Telefono:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='phone_user' >"+json[i].tel+"</span></li></ul></div><div class='col-xs-6'><center><span class='label label-primary'data-campo='tipo_producto' >Datos del Pago</span></center><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Plataforma de pago:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='bank' >"+json[i].bank+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Numero de cuenta:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='numero' >"+json[i].numero+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de cuenta:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='cuenta' >"+json[i].cuenta+"</span></li></ul></div></div>");
                              }
                              

                      });
          }


      </script>
      
      <?php 
     
      ?>
        
<!--modal guardar nuevo -->
        <div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="glyphicon glyphicon-upload"></i>&nbsp; Registrar Nuevas Salida.</h4></h2>
                      </div>
                      <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="portlet-body">
                            <div class="table-scrollable">
                              <table class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                  <div id="register_form">
                                    <form  role="form" action="?admin=salida&crear=crear" method="post" enctype="multipart/form-data">              
                                                        <th>Producto o Servicio </th>
                                                        <th>Cantidad o Monto</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                          <?php
                           $consulta="SELECT * FROM  service";
                           $bd->consulta($consulta);?>
                                   * <select class="form-control"  name="service">
                          <?php
                              while ($fila=$bd->mostrar_registros())
                              { ?>
                                      <option  value="<?php echo $id= $fila->id_service; ?>"><p><?php echo $id= $fila->name_service; ?></p> </option> 
                              <?php 
                              }
                              ?>
                                    </select>
                                       
                                    </td>
                                    <td >
                                       *  <input   required type="number" required name="cantida" required class="form-control">
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                                        <th>Fecha Movimiento</th>
                                                        <th>Cliente</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                       <input class="form-control" type="datetime-local" name="fecha" value="<?php echo $hoy?>" />
                                    </td>
                                      <td width="50%"><center>
                                   <?php
                                   $consulta="SELECT * FROM  user";
                                   $bd->consulta($consulta);?>
                                           <select class="form-control"  name="user">
                                  <?php
                                    while ($fila=$bd->mostrar_registros())
                                    { ?>
                                            <option  value="<?php echo $id= $fila->id_user; ?>"><p><?php echo $fila->name_user; ?></p> </option> 
                                  <?php 
                                  }
                                  ?>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                
                                 <thead>
                                  <tr>
                                               
                                                        <th colspan="2">Motivo del descargo</th>
                                                        
                                </thead>
                                <tbody>
                                  <tr> 
                                    
                                    <td colspan="2" width="100%"><center>
                                   <textarea class="form-control" name="motivo"></textarea>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                 <thead>
                                  <tr>
                                               
                                                        <th>Plataforma de pago</th>
                                                        <th></th>
                                </thead>
                                <tbody>
                                  <tr> 
                                      <td width="50%"><center>
                                       <?php
                                       $consulta="SELECT * FROM  accounts";
                                       $bd->consulta($consulta);?>
                                               <select class="form-control"  name="cuenta">
                                      <?php
                                        while ($fila=$bd->mostrar_registros())
                                        { ?>
                                                <option  value="<?php echo $id= $fila->id_accounts; ?>"><p><?php echo $fila->name_bank_accounts ?> -- <?php echo $fila->tipe_accounts ?></p> </option> 
                                      <?php 
                                      }
                                      ?>
                                      </td>
                                    <td width="50%"><center>
                                     <center>
                                       <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar</button></center>
                                    </td>
                                   
                                    
                                  </tr>
                                </tbody>
                                </form>
                                </div>
                              </table>
                            </div>
                          </div>  
                        </div>
                           
                </div>
              </div>
        </div>
      </div>
      </div>

        <!--modal editar -->
        <div class="modal fade" id="productover" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Consulta De Producto Solicitado.</h4></h2>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="editinplace row">

                          
                    </div>
                  </div>
              </div>
        </div>
        </div>
        <!--modal editar -->
        
  <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
</div>
