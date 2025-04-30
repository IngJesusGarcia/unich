<link href="assets/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        
        <script src="assets/fileinput.js" type="text/javascript"></script>

   
      
 
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


if (isset($_GET['eliminar'])) { 

         $x1=$_GET["codigo"];                    
        if( $x1=="" ){
            echo "<script> alert('campos vacios')</script>";
            echo "<br>";
        }else{

        $consulta="SELECT * FROM service where id_service='$x1'";
        $bd->consulta($consulta);
                while ($fila3=$bd->mostrar_registros()) { 
                    $eliminaimagen=$fila3->imagen;
      
                 if($eliminaimagen!="")
                unlink('./producto/'.$eliminaimagen.'');
                
        }
    }
                        $sql3="delete from service where id_service='".$x1."'";
                        $bd->consulta($sql3);
                        

           
                                    //echo "Datos Guardados Correctamente";
                                    echo '<div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Bien!</b> Se Elimino Correctamente... </div>';
            }






if (isset($_GET['crear'])) { 


  $fondoe= $_FILES["fondo"];
  $nombress=$_POST["nombre"];
  $tipopro=$_POST["tipopro"];
  $descripcion=$_POST["descripcion"];
  $precio=$_POST["precio"];


               
                 if( $nombress==""  ){

                    echo "
   <script> alert('campos vacios')</script>
   ";
                    echo "<br>";
                                }else{

         if($_FILES["fondo"]!=""){
                                      $reporte = null;
                                      for($x=0; $x<count($_FILES["fondo"]["name"]); $x++)
                                      {
                                        $file = $_FILES["fondo"];
                                        $nombre = $file["name"][$x];
                                        $tipo = $file["type"][$x];
                                        $ruta_provisional = $file["tmp_name"][$x];
                                        $size = $file["size"][$x];
                                        
                                        // ✅ Obtener dimensiones de la imagen correctamente
                                        if (@getimagesize($ruta_provisional)) {
                                            list($width, $height) = getimagesize($ruta_provisional);
                                        } else {
                                            $width = 0;
                                            $height = 0;
                                        }
                                        
                                        $carpeta = "./producto/";
                                        

                                        if($size==0){
                                              $sql="INSERT INTO `service`
                                              (`id_service`, `name_service`, `price_service`, `tipo_producto`, `info_service`, `date_registro_pro`,`imagen`) VALUES
                                               (NULL, '$nombress', '$precio', '$tipopro', '$descripcion', '$hoy','img-no.jpg');";                 
                                             $bd->consulta($sql);


                                                        //echo "Datos Guardados Correctamente";
                                                        echo '<div class="alert alert-success alert-dismissable">
                                                                    <i class="fa fa-check"></i>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <b>Bien!</b> Datos Registrados Correctamente... ';

                              
                                                           echo '   </div>';
                                        }elseif($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
                                          {


                                             echo "<p style='color: red'>Error $nombre, el archivo no es una imagen  </p>";
                                          }
                                          else if($size > 1024*1024)// 1024*1024 = 1 MB
                                          {
                                              echo "<p style='color: red'>Error $nombre, el tamaño máximo permitido es 1MB</p>";
                                          }else{

                                             $gale="producto_";
                                             $name2=$gale.$nombre.$nombress;  
                                             $name3 = preg_replace('[\s+]','', $name2);
                                             $src = $carpeta.$name3;
                                               move_uploaded_file($ruta_provisional, $src);
                                             $sql="INSERT INTO `service`
                                              (`id_service`, `name_service`, `price_service`, `tipo_producto`, `info_service`, `date_registro_pro`,`imagen`) VALUES
                                               (NULL, '$nombress', '$precio', '$tipopro', '$descripcion', '$hoy','$name3');";                 
                                             $bd->consulta($sql);


                                                        //echo "Datos Guardados Correctamente";
                                                        echo '<div class="alert alert-success alert-dismissable">
                                                                    <i class="fa fa-check"></i>
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <b>Bien!</b> Datos Registrados Correctamente... ';

                              
                                                           echo '   </div>';
                                          }
                                      }//fin for
                                  }
    }
}
?>




                    <div class="row">
                        <div class="col-md-12">
                          <a style=" margin-left: 10px;" title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nuevo </a> 
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=productos"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista De Productos o servicios</span>
                                       
                                    </div>

                                    <div class="tools "> </div>
                                    
                                </div>

                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th  class="all hidden-print">#</th>
                                                <th class="min-phone-l">Nombre</th>
                                                <th class="min-phone-l">Precio Salida</th>
                                                <th class="min-phone-l">cantidad</th>
                                                <th class="min-phone-l"> Opciones</th>
                                                <th class="none">informacion </th>
                                                <th class="none">Precio Costo </th>
                                                <th class="none">Fecha de Registro</th>
                                                <th class="none">Fecha Vencimiento</th>
                                                <th class="none">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM `service` ORDER by id_service DESC";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_service; ?>

                                             <td  width="5%"><?php echo $fila->id_service; ?></td>
                                             <td  width="25%"><?php echo $fila->name_service; ?></td>
                                             <td  width="25%"><?php echo $fila->price_service; ?></td>
                                             <td  width="20%"> <?php echo $fila->cantida; ?>  </td>
                                             <td width="25%">
                                                <center>
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productoedita" title="editar" id="buttonHola" onclick="myFunction2(this, '<?php echo $id ?>')" ><i class='fa fa-edit'></i> </a> 
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline  " data-toggle="modal"  title="Ver" href="#productover" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" ><i class='fa fa-eye'></i></a>
                                                 <!--  <a class="dt-button buttons-pdf cargar buttons-html5 btn blue btn-outline " data-toggle="modal"  title="Cargar imagen" href="#imagenprin1<?php echo $id  ?>"><i class='fa fa-file-image-o'></i></a> -->
                                                  <a  class="btn red btn-outline sbold derecha"  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold"  href='?admin=productos&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>
                            
                                                
                                                </center> 
                                             </td>
                                             <td><?php echo $fila->info_service; ?></td>
                                          
                                             <td><?php echo $fila->date_registro_pro; ?></td>
                                             <td><?php echo $fila->date_ven_service; ?></td>
                                             <td> <?php echo $fila->tipo_producto; ?>  </td>
                                        </tr>
 <div class="modal fade" id="imagenprin1<?php echo $id  ?>" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Editar imagen del Submodulo: <?php echo  $fila->name_service; ?></h4>
                                                </div>
                                              
                                                <div class="modal-footer">
                                                  
                                                  <input id="perfil1<?php echo  $id ?>" name="imagenprin[]" type="file" multiple class="file-loading">
                                                  <script type="text/javascript">
                                                             $("#perfil1<?php echo  $id ?>").fileinput({
                                                                uploadUrl: "admin/guardaproyecto.php?codigo=<?php echo  $id ?>", // server upload action
                                                                uploadAsync: true,
                                                                maxFileCount: 1,
                                                                showBrowse: false,
                                                                browseOnZoneClick: true
                                                            });
                                                   </script>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
            


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
                      url: "api/editinplace2.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                      "<div class='col-xs-6'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>"+json[i].id+"</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Nombre:</span> <span  data-campo='name_service' style='font-size: 9pt; text-align: left;'>"+json[i].nombre+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Precio:</span> <span style='font-size: 9pt; text-align: left;' data-campo='price_service' >"+json[i].precio+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Costo:</span>  <span style='font-size: 9pt; text-align: left;' data-campo='costo' >"+json[i].costo+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Cantida:</span> <span style='font-size: 9pt; text-align: left;' data-campo='cantida' >"+json[i].cantida+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de Producto:&nbsp; </span><a><span class='label label-primary'data-campo='tipo_producto' >"+json[i].tipo+"</span></a></li><div style='margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;'></div><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Descripción:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='info_service' >"+json[i].info+"</span></li></ul></div><div class='col-xs-6'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'>Detalles</div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/"+json[i].imagen+"'></span></br></br></div></div>");
                              }

                      });
          }
      </script>
      <script>
          var variableGlobal;
           
          function myFunction2(elmnt,clr) { 
           variableGlobal = clr;
              var idd = clr;
              console.log(variableGlobal);
               $.ajax({
                      type: "GET",
                      url: "api/editinplace2.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace2').html(
                                      "<div class='col-xs-6'><table class='editinplace2 table table-striped table-hover'><tr><td width='20%'><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo: &nbsp; </td><td class='id'width='80%' >"+json[i].id+" </span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Nombre:</span></td><td class='editable' data-campo='name_service' width='80%' ><span><a class='link'>"+json[i].nombre+"</a></span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Precio:</span></td><td class='editable' data-campo='price_service' width='80%' ><span><a class='link'>"+json[i].precio+"</a></span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Costo: </span></td><td class='editable' data-campo='costo' width='80%' ><span><a class='link'>"+json[i].costo+"</a></span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de producto:</span></td><td class='editable' data-campo='tipo_producto' width='80%' ><span><a class='link'>"+json[i].tipo+"</a></span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Descripción:</span></td><td class='editable' data-campo='info_service' width='80%' ><span><a class='link'>"+json[i].info+"</a></span></td></tr></table></div><div class='col-xs-6'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'>Detalles</div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/"+json[i].imagen+"'></span></br></br><a class='btn btn-success btn-block movilno' data-toggle='modal' href='#imagenprin' onclick='myFunction3(this, "+json[i].id+")' >Imagen Perfil </a></div></div>");
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
                      id=$(this).closest("table").find(".id").text();
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
                              url: "api/editinplace2.php",
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
      <?php 
      $scrip="<script src='assets/fileinput.js' type='text/javascript'></script>";
      ?>
       <script>
        
          function myFunction3(elmnt,clr) { 
           variableGlobal = clr;
           var fileinput;
              var idd = clr;
              console.log(idd);
 
              document.getElementById('miDiv').innerHTML = "<link href='assets/fileinput.css' media='all' rel='stylesheet' type='text/css' /><input id='perfil' name='imagenprin[]' type='file'  class='file-loading'><?php $scrip ?>";

      $("#perfil").fileinput({
                                        uploadUrl: "admin/guardaproyecto.php?codigo="+idd, // server upload action
                                        uploadAsync: true,
                                        maxFileCount: 1,
                                        showBrowse: false,
                                        browseOnZoneClick: true
                                    });

              
          }
      </script>
        
<!--modal guardar nuevo -->
        <div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Registrar Nuevo producto o servicio.</h4></h2>
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
                                    <form role="form" action="?admin=productos&crear=crear" method="post" enctype="multipart/form-data">              
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input   required type="text" required name="nombre" required class="form-control">
                                    </td>
                                    <td width="50%"><center>
                                      <input class="form-control" required type="number" name="precio" />
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                                        <th>Tipo de Producto</th>
                                                        <th>Descripción</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input class="form-control" required type="text" name="tipopro" />
                                    </td>
                                    <td width="50%" ><center>
                                      <input class="form-control" required type="text" name="descripcion" />
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                               
                                                        <th>Imagen Principal</th>
                                                        <th></th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input class="form-control"  type="file" name="fondo[]" />
                                    </td>
                                    <td width="50%"><center>
                                      <center>
                                       <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Registrar</button></center>
                                    </td>
                                    
                                  </tr>
                                </tbody>

                                </form>
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
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Consultar Producto o  servicios.</h4></h2>
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
        <div class="modal fade" id="productoedita" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i>&nbsp; Editar Producto o  servicios.</h4></h2>
                      </div>
                  <div style="margin-top: 1px; background-color: #2e77bc; height: 1px; width: 100%;"></div>
                    <div class="modal-body">
                        <div class="editinplace2 row">
                           
                               
                        </div>     
                    </div>
                  </div>
              </div>
        </div>
        </div>

        <!-- modal de galeria interna-->
         <div class="modal fade "    id="imagenprin" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                 <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                         <button  type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i>&nbsp; Editar Imagen de producto servicios.</h4></h2>
                      </div>    
                                              <div id="miDiv"></div>
                                                
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
            


  <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>

</div>
<link href="assets/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="assets/fileinput.js" type="text/javascript"></script>
