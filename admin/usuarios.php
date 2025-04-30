
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
?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista De Productos o servicios</span>
                                    </div>
                                    <div class="tools"> </div>
                                    <a class="btn red btn-outline sbold derecha" data-toggle="modal" href="#productoguarda">Nuevo </a> 
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th class="all">Nombre</th>
                                                <th class="min-phone-l">precio</th>
                                                <th class="all">cantidad</th>
                                                <th class="all"> Opciones</th>
                                                <th class="none">informacion </th>
                                                <th class="none">Fecha de Registro</th>
                                                <th class="none">Fecha Vencimiento</th>
                                                <th class="none">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM service";

                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_service; ?>
                                             <td><?php echo $fila->name_service; ?></td>
                                             <td><?php echo $fila->price_service; ?></td>
                                             <td> <?php echo $fila->cantidad; ?>  </td>
                                             <td>
                                                 <a class="btn red btn-outline sbold derecha" data-toggle="modal" href="#productoedita" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" >Editar </a> 
                                                  <a class="btn red btn-outline sbold derecha" data-toggle="modal" href="#productover" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" >Ver Detalle </a> 
                                             </td>
                                             <td><?php echo $fila->info_service; ?></td>
                                             <td><?php echo $fila->date_registro_pro; ?></td>
                                             <td><?php echo $fila->date_ven_service; ?></td>
                                             <td> <?php echo $fila->tipo_producto; ?>  </td>
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
                      url: "admin/editinplace2.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                      "<tr><td class='id'width='10%'>"+json[i].id+"</td><td class='editable' data-campo='name_service' width='20%' ><span><a class='link'>"+json[i].nombre+"</a></span></td><td class='editable' data-campo='price_service' width='20%' ><span><a class='link'>"+json[i].apellido+"</a></span></td></tr>");
                              }
                      });
                  var td,campo,valor,id;
                  $(document).on("click","td.editable span",function(e)
                  {
                      e.preventDefault();
                      $("td:not(.id)").removeClass("editable");
                      td=$(this).closest("td");
                      campo=$(this).closest("td").data("campo");
                      valor=$(this).text();
                      id=$(this).closest("tr").find(".id").text();
                      td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
                  });
                  
                  $(document).on("click",".cancelar",function(e)
                  {
                      e.preventDefault();
                      td.html("<span><a class='link'>"+valor+"</a></span>");
                      $("td:not(.id)").addClass("editable");
                  });
                  
                  $(document).on("click",".guardar",function(e)
                  {
                      $(".mensaje").html("<img src='img/loading.gif'>");
                      e.preventDefault();
                      nuevovalor=$(this).closest("td").find("input").val();
                      if(nuevovalor.trim()!="")
                      {
                          $.ajax({
                              type: "POST",
                              url: "admin/editinplace2.php",
                              data: { campo: campo, valor: nuevovalor, id:id }
                          })
                          .done(function( msg ) {
                              $(".mensaje").html(msg);
                              td.html("<span><a class='link'>"+nuevovalor+"</a></span>");
                              $("td:not(.id)").addClass("editable");
                              setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
                          });
                      }
                      else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
                  });
          }
      </script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!--modal guardar nuevo -->
        <div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #f2dede; color: #a94446;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><i class="fa fa-warning"></i> This asset is subject to DRH and the HDD contents must be preserved in any/all circumstances.</h4>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="row">
                           <div class="col-xs-6">
                                <ul class="list-unstyled" style="line-height: 2">
                                    <li><span class="text-success"><i class="fa fa-database"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">DRH ID</span> <span style="font-size: 9pt; text-align: left;">296</span></li>
                                    <li><span class="text-success"><i class="fa fa-desktop"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Hostname</span> <span style="font-size: 9pt; text-align: left;">BDSPUKL0540543</span></li>
                                    <li><span class="text-success"><i class="fa fa-building-o"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Location Stored</span> <span style="font-size: 9pt; text-align: left;">BKP0203231</span></li>
                                    <li><span class="text-success"><i class="fa fa-user"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">User</span> <span style="font-size: 9pt; text-align: left;">Test User</span></li>
                                    
                                    <a href="#"><span class="label label-primary">View Spring record</span></a> <a href="#"><span class="label label-primary">View on EIP</span></a>
                                    
                                    <div style="margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;"></div>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Staff Number</span> <span style="font-size: 8pt; text-align: left;">B0834933</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Employment Status</span> <span style="font-size: 8pt; text-align: left;">Current</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Login ID</span> <span style="font-size: 8pt; text-align: left;">broyTest</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Department</span> <span style="font-size: 8pt; text-align: left;">Test Department</span></li>
                                </ul>
                                      <table class="editinplace table table-striped table-hover">
                                          <tr><center>
                                              <th>Cod.</th>
                                              <th>Nombre</th>
                                              <th>precio</th>
                                          </tr>
                                      </table>
                            </div>
                            <div class="col-xs-6">
                                <div class="well">
                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;">Engineer Actions</div>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-building-o"></i> Change Location</button>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-refresh"></i> Reclaim / Replace</button>
                                          <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-warning"></i> Report Discrepancy</button>

                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px; margin-top: 6px;">Admin Actions</div>
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-arrow-down"></i> Drop In</button>
                                        <a href="/forgot/" class="btn btn-primary btn-block"><i class="fa fa-search"></i> CFI</a>
                              </div>
                          </div>
                    </div>
                  </div>
              </div>
        </div>
        </div>

        <!--modal editar -->
        <div class="modal fade" id="productoedita" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i> Editar Producto o servicios.</h4></h2>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="row">
                           <div class="col-xs-6">
                                <table class="editinplace table table-striped table-hover">
                                    
                                </table>
                                <ul class="list-unstyled" style="line-height: 2">
                                    <li><span class="text-success"><i class="fa fa-database"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">DRH ID</span> <span style="font-size: 9pt; text-align: left;">296</span></li>
                                    <li><span class="text-success"><i class="fa fa-desktop"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Hostname</span> <span style="font-size: 9pt; text-align: left;">BDSPUKL0540543</span></li>
                                    <li><span class="text-success"><i class="fa fa-building-o"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Location Stored</span> <span style="font-size: 9pt; text-align: left;">BKP0203231</span></li>
                                    <li><span class="text-success"><i class="fa fa-user"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">User</span> <span style="font-size: 9pt; text-align: left;">Test User</span></li>
                                    
                                    <a href="#"><span class="label label-primary">View Spring record</span></a> <a href="#"><span class="label label-primary">View on EIP</span></a>
                                    
                                    <div style="margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;"></div>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Staff Number</span> <span style="font-size: 8pt; text-align: left;">B0834933</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Employment Status</span> <span style="font-size: 8pt; text-align: left;">Current</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Login ID</span> <span style="font-size: 8pt; text-align: left;">broyTest</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Department</span> <span style="font-size: 8pt; text-align: left;">Test Department</span></li>
                                </ul>
                            </div>
                            <div class="col-xs-6">
                                <div class="well">
                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;">Engineer Actions</div>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-building-o"></i> Change Location</button>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-refresh"></i> Reclaim / Replace</button>
                                          <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-warning"></i> Report Discrepancy</button>

                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px; margin-top: 6px;">Admin Actions</div>
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-arrow-down"></i> Drop In</button>
                                        <a href="/forgot/" class="btn btn-primary btn-block"><i class="fa fa-search"></i> CFI</a>
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
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #f2dede; color: #a94446;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><i class="fa fa-warning"></i> This asset is subject to DRH and the HDD contents must be preserved in any/all circumstances.</h4>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="row">
                           <div class="col-xs-6">
                                <ul class="list-unstyled" style="line-height: 2">
                                    <li><span class="text-success"><i class="fa fa-database"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">DRH ID</span> <span style="font-size: 9pt; text-align: left;">296</span></li>
                                    <li><span class="text-success"><i class="fa fa-desktop"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Hostname</span> <span style="font-size: 9pt; text-align: left;">BDSPUKL0540543</span></li>
                                    <li><span class="text-success"><i class="fa fa-building-o"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">Location Stored</span> <span style="font-size: 9pt; text-align: left;">BKP0203231</span></li>
                                    <li><span class="text-success"><i class="fa fa-user"></i></span> <span style="color: #acacac; font-size: 9pt; text-align: left;">User</span> <span style="font-size: 9pt; text-align: left;">Test User</span></li>
                                    
                                    <a href="#"><span class="label label-primary">View Spring record</span></a> <a href="#"><span class="label label-primary">View on EIP</span></a>
                                    
                                    <div style="margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;"></div>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Staff Number</span> <span style="font-size: 8pt; text-align: left;">B0834933</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Employment Status</span> <span style="font-size: 8pt; text-align: left;">Current</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Login ID</span> <span style="font-size: 8pt; text-align: left;">broyTest</span></li>
                                    <li><span style="color: #acacac; font-size: 8pt; text-align: left;">Department</span> <span style="font-size: 8pt; text-align: left;">Test Department</span></li>
                                </ul>
                                      <table class="editinplace table table-striped table-hover">
                                          <tr><center>
                                              <th>Cod.</th>
                                              <th>Nombre</th>
                                              <th>precio</th>
                                          </tr>
                                      </table>
                            </div>
                            <div class="col-xs-6">
                                <div class="well">
                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;">Engineer Actions</div>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-building-o"></i> Change Location</button>
                                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-refresh"></i> Reclaim / Replace</button>
                                          <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-warning"></i> Report Discrepancy</button>

                                      <div style="color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px; margin-top: 6px;">Admin Actions</div>
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-arrow-down"></i> Drop In</button>
                                        <a href="/forgot/" class="btn btn-primary btn-block"><i class="fa fa-search"></i> CFI</a>
                              </div>
                          </div>
                    </div>
                  </div>
              </div>
        </div>
        </div>

  <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
</div>
