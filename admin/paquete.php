
<script LANGUAGE="JavaScript">
function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea eliminarlo se eliminara todo el contenido ?"))
    window.location.href = url;
else
    return false ;
}
</script>
<?php


if (isset($_GET['eliminar'])) { 


 $x1=$_GET["codigo"];


                       
if( $x1=="" ){
    echo "";
}else{
$bd3 = new GestarBD;    


 $sql1="SELECT * FROM paquete INNER JOIN token ON token.idtoken_idpaquete=paquete.id_paquete where id_paquete='$x1'";
$bd3->consulta($sql1);

            if ($bd3->numeroFilas() > 0) {
        
 echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Denegado </b>No se elimino el paquete esta en uso';

                               echo '   </div>';
                                               }else{

$sql="delete from paquete where id_paquete='$x1'";
$bd->consulta($sql);

echo '<div class="alert alert-success alert-dismissable">
      <i class="fa fa-check"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <b>Bien!</b> Se Elimino Correctamente... </div>';                                    

    }

  }

}




if (isset($_GET['guarda'])) { 

  
  
 echo  $nombre=$_POST["nombre"]; 
 echo  $precio=$_POST["precio"];
  


                    
if($nombre=="" ){
echo "";
}else{

$sql="INSERT INTO `paquete` (`id_paquete`, `precio`, `nombre_p`) VALUES (NULL, '$precio', '$nombre')";
$bd->consulta($sql);
                                  
//$sql="UPDATE catalogo SET 
//titulo='$titulo', contenido='$contenido',imgfondo='$imgfondo',imgprincipal='$imgprincipal',img1='$img1', img2='$img2', img3='$img3' where id_catalogo='$x1'";
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Registrados Correctamente... ';

                               echo '   </div>';


     
}
}



?>
<div class="portlet light bordered">


                                
                                <div class="portlet-body">
                                   
                                    <div class="tabbable tabbable-tabdrop">
                                        <ul class="nav nav-tabs">

                                            <li class="active">
                                                <a href="#tab1" data-toggle="tab">Crear Paquetes</a>
                                            </li>
                                           
                                           
                                            
                                        </ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab1">
    <!-- contenido datos basicos -->

  
<div class="col-md-12">



<div class="portlet-body">
   <div class="table-scrollable">
       <table class="table table-striped table-hover">
          <thead>
                                                         
                    <tr>
                    <form role="form" action="?admin=paquete&guarda" method="post" enctype="multipart/form-data">              
                    <center>
                      <th><center>Nombre del Paquete</center></th>
                      <th><center>Precio</center></th>
                    </center>
                    </tr>
          </thead>
                    <tbody>
                    <tr> 
                        
                        <td>

                  <input   type="text" required type="tex" name="nombre" value="" required class="form-control"> 
                        </td>
                        <td>
                  <input   type="text" required type="number" name="precio" value="" required class="form-control"> 
                        </td>
                       
                    </tr>

                    </div>                 
                    </tbody> 
                   
            
                    <tbody>
                       <tr> 
  
                 <td>
                 </td>
                    <td>
                 
                    <center>
<button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Guardar </button>
</center>
                      </td>
                    </tr>
               
                    </div>                 
                    </tbody>  
                     </table>
                     </form>


     
                    </table> 
</div>
</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->

    </div>

 

      </div>
    </div>
  </div>
</div>
</IMG>
</center>






<style type="text/css">
   
    table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
  
    td {padding:5px;border:solid #ddd;border-width:0 0 1px;
    }
        .editable span{display:block;}
        .editable span:hover {background:url(img/edit.png) 30% 0  no-repeat; cursor:pointer}

        a.link   
{   
 text-decoration:none;   
 border-bottom: thin dashed;
} 
        
        td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
        a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
            .guardar{background:url(img/save.png) 0 0 no-repeat}
            .cancelar{background:url(img/cancel.png) 0 0 no-repeat}
    
    .mensaje{display:block;text-align:center;margin:0 0 20px 0}
        .ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
        .ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
</style>

<div class="row">
<div class="col-md-12">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-comments"></i>Lista de Paquetes</div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
</div>
</div>


<div class="portlet-body">
        <div class="table-scrollable">
        
<table class="editinplace table table-striped table-hover">
            <tr>
                <th>Cod.</th>
                <th>Paquete</th>
                <th>Precio</th>
                <th>Eliminar</th>
                
            </tr>
        </table>
    </div>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    $(document).ready(function() 
    {
        /* OBTENEMOS TABLA */
        $.ajax({
            type: "GET",
            url: "admin/editinplace.php?tabla=1"
        })
        .done(function(json) {
            json = $.parseJSON(json)
            for(var i=0;i<json.length;i++)
            {
                $('.editinplace').append(
                    "<tr><td class='id'width='10%' >"+json[i].id+"</td><td class='editable' data-campo='nombre_p' width='40%' ><span><a class='link'>"+json[i].nombre_p+"</a></span></td><td class='editable' data-campo='precio' width='40%' ><span><a class='link'>"+json[i].precio+"</a></span></td><td width='10%'><a onclick='if(confirmDel() == false){return false;}' class='btn btn-danger btn-lg' href='?admin=paquete&eliminar&codigo="+json[i].id+"'><i class='icon-trash'></i></a></td></tr>");
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
                    url: "admin/editinplace.php",
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
    });
    
    </script>



<!-- Mas scripts en -->

<!-- END QUICK SIDEBAR -->
</div>


</div>
</div>
</div>
</div>
</div>
</div>
