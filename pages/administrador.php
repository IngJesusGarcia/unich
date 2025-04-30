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
if (isset($_GET['edita'])) { 


   $nombre=$_POST["nombre"];
   $apellido=$_POST["apellido"];
 //$o=$_POST["logo"];
 //$imgprincipal=$_POST["portada"];
 //$img1=$_POST["favicon"];  
    $correo=$_POST["correo"]; 
    $pass=$_POST["pass"];
 



                            if( $nombre==""  )
                {

                    
                }else{
                   

$sql="UPDATE administrador SET nombre='$nombre', apellido='$apellido', correo='$correo',pass='$pass' where id='$iduser'";  
$bd->consulta($sql);
   
                            //echo "Datos Guardados Correctamente";   ,imgfondo='$nom',imgprincipal='$nom2',img1='$nomimg1', img2='$nomimg2', img3='$nomimg3',url='$url'
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Editados Correctamente... ';

                               echo '   </div>';
                            }
                }

?>


<div class="row">
<div class="col-md-12">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-comments"></i>Datos Del Usuario</div>
<div class="tools">
<a href="javascript:;" class="reload"> </a>
</div>
</div>


<div class="portlet-body">
        <div class="table-scrollable">
        
<table class="editinplace table table-striped table-hover">
            <tr>
                <th>Cod.</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>contraseña</th>
                <th>Eliminar</th>
                
            </tr>
        </table>
    </div>
    
    <script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
    <script>
    $(document).ready(function() 
    {
        /* OBTENEMOS TABLA */
        $.ajax({
            type: "GET",
            url: "pages/editinplace2.php?tabla=1&idu=<?php echo $idlog ?>"
        })
        .done(function(json) {
            json = $.parseJSON(json)
            for(var i=0;i<json.length;i++)
            {
                $('.editinplace').append(
                    "<tr><td class='id'width='10%' >"+json[i].id+"</td><td class='editable' data-campo='name_user' width='20%' ><span><a class='link'>"+json[i].nombre+"</a></span></td><td class='editable' data-campo='last_name_user' width='20%' ><span><a class='link'>"+json[i].apellido+"</a></span></td><td class='editable' data-campo='mail_user' width='20%' ><span><a class='link'>"+json[i].correo+"</a></span></td><td class='editable' data-campo='pw_user' width='20%' ><span><a class='link'>"+json[i].pw+"</a></span></td><td width='10%'><a onclick='if(confirmDel() == false){return false;}' class='btn btn-danger btn-lg' href='?mod=galeria&eliminar&codigo="+json[i].id+"'><i class='icon-trash'></i></a></td></tr>");
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
                    url: "pages/editinplace2.php",
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
</div>
</div>
<!-- <a class="btn red btn-outline sbold derecha" data-toggle="modal" href="#1">¿Ayuda? </a> -->
</div>
</div>
</div>




</div>
<!-- END SAMPLE TABLE PORTLET-->
<?php
if (isset($_GET['editar'])) { 

?>

<div class="row">
<div class="col-md-12">
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-comments"></i>Editar Administrador</div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
</div>
</div>


<div class="portlet-body">
        <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
<?php


//SELECT *FROM categoria INNER JOIN catalogo ON categoria.id_categoria = catalogo.id_categoria 
  $consulta="SELECT * FROM administrador where id=$iduser";

                                        /*$consulta="SELECT id_usuarios,nombre,cedula ,apellido, correo, telefono, direccion FROM usuarios ORDER BY id_usuarios ASC ";*/
                                    ?>

                            <tr>
                        
                    <center>
                        <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Correo</th>
                       
                        
                            
                    </thead>
                    <tbody>
<?php
                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrar_registros()) { 
?>
       
                    <tr> 
  <form role="form" action="?mod=administrador&edita=edita" method="post" enctype="multipart/form-data"> 
                  
                        <td>
       
    <input class="form-control" required type="text" id="exampleInputFile"  name="nombre"  value="<?php echo $fila->nombre; ?>" >
                      
                        </td>
                        <td>
       
  <input class="form-control" required type="text" id="exampleInputFile" name="apellido" value="<?php echo $fila->apellido; ?>"  >
                      
                        </td>
                        <td>
       
    <input class="form-control"   required type="email" id="exampleInputFile"  name="correo" value="<?php echo $fila->correo; ?>" >
                      
                        </td>
                       
                    </tr>

  <tr>
                        
                    <center>
                        <th>Contraseña</th>
                <th></th>
                         <th><center>Opción</center></th>
                      
                        
                            
                    </thead>
                    <tbody>
                    </tr>
                    <tr>
                      <td>
       
                <input class="form-control"  required type="password" id="exampleInputFile" name="pass" value="<?php echo $fila->pass; ?>" >
                      
                        </td>
                        <td>
       
                      
                      
                        </td>
                        
                     <td>
                    <center>
                    
                       <center>
<button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" value="Guardar">Editar  Admin</button>
</center>    
                     </center>
                     </td>
                    </center>
                    <?php } ?>
                    </tbody>
                    </table>

 
</div>
<div class="col-md-10"></div>

</form>



</div>
</div>
<!-- END SAMPLE TABLE PORTLET-->
</div>
</div>
<?php
}
?>
<!-- Mas scripts en -->

<!-- END QUICK SIDEBAR -->

</div>
</div>
</div>

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