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

if (isset($_GET['guarda'])) { 

  
  
  $codigo=$_POST["codigo"]; 
   $limite=$_POST["limite"];
  $paquete=$_POST["paquete"];


                    
if($codigo=="" ){
echo "";
}else{


$sql="INSERT INTO `token` (`idtoken`, `token`, `limite`, `idtoken_idpaquete`) VALUES (NULL, '$codigo', '$limite', '$paquete');";
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


//eliminar 
if (isset($_GET['eliminar'])) { 


 $x1=$_GET["codigo1"];
                     
if( $x1=="" ){
    echo "";
   
}else{

$sql2="delete from token where idtoken='$x1'";
$bd->consulta($sql2);
                            //echo "Datos Guardados Correctamente";
                            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Se Elimino Correctamente... </div>';

}

}

?>
<div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista De Codigos</span>
                                    </div>
                                  
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr >
                                           
                                                <th class="all">Plan o paquete</th>
                                                <th class="min-phone-l">Token</th>
                                                <th class="min-phone-l">Limite</th>
                                                <th class="min-phone-l">Usados</th>
                                                <th class="none">Eliminar</th>
                                               

                                            </tr>
                                        </thead>
                                        <tbody>
<tr>
                                           <?php



    $consulta="SELECT * FROM token
     INNER JOIN paquete ON token.idtoken_idpaquete=paquete.id_paquete";
    $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros()) { 
      
echo "
       
          <td>
 ".$fila->nombre_p."
 
          </td>

          <td>

".$fila->token."


          </td>

          <td>
 ".$limite1=$fila->limite."
          </td>

          <td>
";

$count="SELECT count(id_token) FROM administrador WHERE id_token='$fila->idtoken'";    
$suma1 = $db->query($count);
 while ($fila1 =$suma1->fetch_row()) {
     echo   $suma=$fila1[0]; 
 }  

?>
          </td>                                   
                                 
                              <td> 

<?php 
$a=1;
  if($suma<$a){
  ?>
  <a onclick="if(confirmDel() == false){return false;}" class="btn btn-danger" href="?admin=listac&eliminar&codigo1=<?php echo  $fila->idtoken ?>"><i class="icon-trash"></i></a> 
  <?php
  }else{
    echo "<p style='color: red'>Este Codigo esta En Uso</p>";
  }
 
?>

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
                              </div>


</div>
