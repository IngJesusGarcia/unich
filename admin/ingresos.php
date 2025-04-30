<style type="text/css">
  @media print {
   .noimprimir{
    font-size: 10pt
  }
}

</style>




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
echo $idlog;

 
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


        if (isset($_GET['eliminar'])) { 

                 $x1=$_GET["codigo"];                    
                if( $x1=="" ){
                    echo "<script> alert('campos vacios')</script>";
                    echo "<br>";
                }else{
                                $sql3="delete from `movimientosaldo` where `movimientosaldo`.`id_msaldo`='".$x1."'";
                                $bd->consulta($sql3);
                               

                   
                                            //echo "Datos Guardados Correctamente";
                                            echo '<div class="alert alert-success alert-dismissable">
                                                        <i class="fa fa-check"></i>
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Bien!</b> Se Elimino Correctamente... </div>';
                    }
        }


                if (isset($_GET['crear'])) 
                { 
                         $divisa = utf8_decode($_POST['divisa']);
                         $cuenta = utf8_decode($_POST['cuenta']);
                         $cantida = utf8_decode($_POST['cantida']);
                         $fecha = utf8_decode($_POST['fecha']);
                         $motivo = utf8_decode($_POST['motivo']);
                        $resultado = str_replace("T", " ", $fecha);

                        if($fecha==""){
                          $resultado= $hoy = date("Y-m-d H:m:s");
                         }
                                 if( $cantida==""  ){

                                    echo "
                                    <script> alert('campos vacios')</script>
                                                ";
                                    echo "<br>";
                                }else{
                                  //consultamos si existe
                                  $consulta="SELECT * FROM `saldo` where id_saldo_id_accounts='$cuenta' and id_divisa_id_saldo='$divisa'";
                                         $bd->consulta($consulta);
                                         //verificar que exista la divisa y la cuenta bancaria 
                                  if ($bd->numeroFilas() > 0) { 

                                          while ($fila=$bd->mostrar_registros()) { 
                                           $totalactual= $fila->cantida_saldo; 
                                           $id_saldo= $fila->id_saldo; 
                                          }
                                             $grantotal=$totalactual+$cantida;

                                              $editar="UPDATE `saldo` SET `cantida_saldo` = '$grantotal' WHERE `saldo`.`id_saldo` = '$id_saldo'";
                                              $bd->consulta($editar);
                                        }else{

                                          //se inserta el banco y su divisa nueva
                                         $sql1="INSERT INTO `saldo` (`id_saldo`, `cantida_saldo`, `id_saldo_id_accounts`, `id_divisa_id_saldo`) VALUES (NULL, '$cantida', '$cuenta', '$divisa')";
                                         echo   $bd->consulta($sql1);

                                          $consulta="SELECT * FROM `saldo` where id_saldo_id_accounts='$cuenta' and id_divisa_id_saldo='$divisa'";
                                          $bd2 = new GestarBD;   
                                           while ($fila1=$bd2->mostrar_registros()) { 
                                           $totalactual= $fila1->cantida_saldo; 
                                           $id_saldo= $fila1->id_saldo; 
                                          }
                                         
                                        }
                                                  //suma de cantidad actual mas la nueva
                                                

                                      $sql="INSERT INTO `movimientosaldo` (`id_msaldo`, `id_msaldo_id_saldo`, `cantida_msaldo`, `fecha_msaldo`,`motivo_msaldo`, `movimiento_emisor`, `tipo_mmovimiento`) VALUES (NULL, '$id_saldo', '$cantida', '$resultado', '$motivo', '$idlog', 'entrada')";
                                              $bd->consulta($sql);

                                                        //echo "Datos Guardados Correctamente";
                                                        echo '<div class="alert alert-success alert-dismissable">
                                                                    <i class="fa fa-check"></i>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <b>Bien!</b> Datos Registrados Correctamente... ';
                                                           echo '   </div>';
                                  
                    }
                }


      if (isset($_GET['crear2'])) { 
                         
                         $saldo = utf8_decode($_POST['saldo']);
                         $cantida = utf8_decode($_POST['cantida']);
                         $fecha = utf8_decode($_POST['fecha']);
                         $motivo = utf8_decode($_POST['motivo']);
                          
                        $resultado = str_replace("T", " ", $fecha);

                        if($fecha==""){
                          $resultado= $hoy = date("Y-m-d H:m:s");
                         }
                                 if( $cantida==""  ){

                                    echo "<script> alert('campos vacios')</script>";
                                    echo "<br>";
                                }else{
                                  
                                  //consultamos si existe
                                  $consulta="SELECT * FROM `saldo` where id_saldo='$saldo'";
                                         $bd->consulta($consulta);
                                         //verificar que exista la divisa y la cuenta bancaria 
                                  if ($bd->numeroFilas() > 0) { 

                                          while ($fila=$bd->mostrar_registros()) { 
                                           $totalactual= $fila->cantida_saldo; 
                                           $id_saldo= $fila->id_saldo; 
                                          }
                                             $grantotal=$totalactual-$cantida;

                                              $editar="UPDATE `saldo` SET `cantida_saldo` = '$grantotal' WHERE `saldo`.`id_saldo` = '$id_saldo'";
                                              $bd->consulta($editar);
                                        }
                                                  //suma de cantidad actual mas la nueva
                                                

                                    $sql="INSERT INTO `movimientosaldo` (`id_msaldo`, `id_msaldo_id_saldo`, `cantida_msaldo`, `fecha_msaldo`,`motivo_msaldo`, `movimiento_emisor`, `tipo_mmovimiento`) VALUES (NULL, '$id_saldo', '$cantida', '$resultado', '$motivo', '$idlog', 'salida')";
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
                      
                          <a style=" margin-left: 10px;"  title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda2">Nuevo Deposito Monetario </a> 
                          <a style=" margin-left: 10px;"  title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda3">Registrar Gasto </a> 
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=ingresos"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Ingreos o Entradas $ </span>
                                       
                                    </div>

                                    <div class="tools "> </div>
                                    
                                </div>

                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th  class="all hidden-print">#</th>
                                                <th class="min-phone-l">Producto o servicio</th>
                                                <th class="min-phone-l">Cantida</th>
                                                <th class="min-phone-l">Fecha de Movimiento</th>
                                                <th  class="min-phone-l hidden-print noimprimir"> Opciones</th>
                                                <th class="none">Costo De Entrada</th>
                                                <th class="none">Tipo de Movimiento</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM movimientosaldo INNER JOIN saldo on movimientosaldo.id_msaldo_id_saldo=saldo.id_saldo 
                                        INNER JOIN accounts ON saldo.id_saldo_id_accounts=accounts.id_accounts 
                                        INNER JOIN divisas ON saldo.id_divisa_id_saldo=divisas.id_divisas  ";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_msaldo; ?>
                                        <?php $icono= $fila->tipo_mmovimiento; ?>

                                             <td  width="5%"><?php echo $fila->id_msaldo; ?></td>
                                             <td  width="25%"> <?php echo $fila->name_bank_accounts; ?></td>
                                             <td  width="25%"><?php echo $fila->cantida_msaldo; ?><?php echo $fila->simbolo_divisa; ?> &nbsp;
                                             <?php if($icono=="entrada"){
                                              echo "<span class='badge badge-info'><i class='fa fa-arrow-down' aria-hidden='true'></i></span> ";
                                             }elseif($icono=="salida"){
                                                 echo "<span class='badge badge-danger'><i class='fa fa-arrow-up' aria-hidden='true'></i></span> ";
                                             }
                                             ?>

                                              </td>
                                             <td  width="20%"><?php echo $fila->fecha_msaldo; ?>  </td>
                                             <td width="25%" class="hidden-print noprin">
                                                <center>
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productover"   title="ver" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" ><i class='fa fa-eye'></i></a>
                                                  <a  class="btn red btn-outline sbold "  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold"  href='?admin=ingresos&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>
                                                </center> 
                                             </td>
                                             <td><?php echo $fila->motivo_msaldo; ?></td>
                                              <td><?php echo $fila->tipo_mmovimiento; ?></td> 
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
                      url: "api/ingresos.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                      "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>"+json[i].id+"</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de cuenta:</span> <span  data-campo='tipe_accounts' style='font-size: 9pt; text-align: left;'>"+json[i].nombre+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantidad:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida_msaldo' >"+json[i].cantida+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Fecha:</span> <span style='font-size: 9pt; text-align: left;' data-campo='fecha_msaldo' >"+json[i].fecha+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de movimiento:&nbsp; </span><span data-campo='tipo_movimiento' >"+json[i].bank+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Divisa:&nbsp; </span><span data-campo='simbolo_divisa' >"+json[i].divisa+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Motivo:&nbsp; </span><span data-campo='motivo_msaldo' >"+json[i].motivo+"</span></li></ul></div></div></div>");
                              }

                      });
          }
      </script>
      
      <?php 
     
      ?>
        

  <!--  modal de nuevo deposito eectivo-->    
    <div class="modal fade" id="productoguarda2" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-plus-square-o"></i>&nbsp; Nueva entrada de dinero.</h4></h2>
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
                                    <form  role="form" action="?admin=ingresos&crear=crear" method="post" enctype="multipart/form-data">              
                                                        <th>Banco o monedero</th>
                                                        <th>Cantidad o Monto</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
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
                                    <td >
                                        <input   required type="number" required name="cantida" required class="form-control">
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  
                                                        <th>Divisa</th>
                                                        <th>Fecha de movimiento </th>

                                </thead>
                                 <tbody>
                                  <tr> 
                                      <td width="50%"><center>
                                       <?php
                                       $consulta="SELECT * FROM  divisas";
                                       $bd->consulta($consulta);?>
                                               <select class="form-control"  name="divisa">
                                      <?php
                                        while ($fila=$bd->mostrar_registros())
                                        { ?>
                                                <option  value="<?php echo $id= $fila->id_divisas; ?>"><p>  <?php echo $fila->simbolo_divisa ?>&nbsp;&nbsp; <?php echo $fila->name_divisa; ?></p> </option> 
                                      <?php 
                                      }
                                      ?>
                                      </td>
                                      <td>
                                        <input class="form-control" type="datetime-local" name="fecha" value="<?php echo $hoy?>" />
                                      </td>
                                  
                                   
                                    
                                  </tr>
                                </tbody>
                                 <thead>
                                  <tr>
                                               
                                                        <th colspan="2">Motivo del ingreso</th>
                                                        
                                </thead>
                                <tbody>
                                  <tr> 
                                    
                                    <td colspan="2" width="100%"><center>
                                   <textarea class="form-control" name="motivo"></textarea>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr><center>
                                    <td width="50%" colspan="2" >
                                        <center><button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar</button></center>
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

<div class="modal fade" id="productoguarda3" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-plus-square-o"></i>&nbsp; Nueva Salida de dinero.</h4></h2>
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
                                    <form  role="form" action="?admin=ingresos&crear2=crear2" method="post" enctype="multipart/form-data">              
                                                        <th>Banco o monedero</th>
                                                        <th>Cantidad o Monto</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%">
                                       <?php
                                       $consulta="SELECT * FROM saldo INNER JOIN accounts ON saldo.id_saldo_id_accounts=accounts.id_accounts 
                                        INNER JOIN divisas ON saldo.id_divisa_id_saldo=divisas.id_divisas where cantida_saldo>0";
                                       $bd->consulta($consulta);?>
                                               <select class="form-control"  name="saldo">
                                      <?php
                                        while ($fila=$bd->mostrar_registros())
                                        { ?>
                                                <option  value="<?php echo $id= $fila->id_saldo; ?>"><p><?php echo $fila->name_bank_accounts ?>&nbsp; <n style="float: left;"> <?php echo $fila->cantida_saldo ?><?php echo $fila->simbolo_divisa ?></n></p> </option> 
                                      <?php 
                                      }
                                      ?>
                                                                         </td>
                                    <td >
                                        <input   required type="number" required name="cantida" required class="form-control">
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  
                                                        
                                                        <th>Fecha de movimiento </th>
                                                        <th >Motivo del ingreso</th>

                                </thead>
                                 <tbody>
                                  <tr> 
                                      
                                      <td>
                                        <input class="form-control" type="datetime-local" name="fecha" value="<?php echo $hoy?>" />
                                      </td>
                                   <td  width="100%"><center>
                                   <textarea class="form-control" name="motivo"></textarea>
                                    </td>
                                   
                                    
                                  </tr>
                                </tbody>
                                <tbody>
                                  <tr><center>
                                    <td width="50%" colspan="2" >
                                        <center><button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar</button></center>
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
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Datos del Registro de entrada.</h4></h2>
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
