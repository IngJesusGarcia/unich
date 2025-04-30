<div class="portlet light bordered">


                                
                                <div class="portlet-body">
                                   
                                    <div class="tabbable tabbable-tabdrop">
                                        <ul class="nav nav-tabs">

                                            <li class="active">
                                                <a href="#tab1" data-toggle="tab">Crear Codigos</a>
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
                    <form role="form" action="?admin=listac&guarda" method="post" enctype="multipart/form-data">              
                    <center>
                      <th><center>Codigo Nuevo</center></th>
                      <th><center>Limite</center></th>
                    </center>
                    </tr>
          </thead>
                    <tbody>
                    <tr> 
                        
                        <td>
 <?php
function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
 
//Ejemplo de uso
 
 // genera un código de 6 caracteres de longitud.
?>
                  <input   type="text" required type="tex" name="codigo" value="<?php echo generarCodigo(6) ?>" required class="form-control"> 
                        </td>
                        <td>
                  <input   type="number" maxlength="number" required type="text" min="1" name="limite" value="1" required class="form-control"> 
                        </td>
                       
                    </tr>

                    </div>                 
                    </tbody> 
                   
                    <th><center>Seleccionar Paquete</center></th>
                    <th><center></center></th>   
                      </tr>
                        </thead>
                             
                    </tbody>  

                     <th><center></center></th>
                    <th><center></center></th>
                       
                      </tr>
                        </thead>
                    <tbody>
                       <tr> 
   <?php
    $consulta="SELECT * FROM paquete ";
      $bd->consulta($consulta);

   ?>

                   <td>
<select class="form-control"  name="paquete">
 <?php while ($pagina=$bd->mostrar_registros()) {
  ?>
  <option  value="<?php echo  $id=$pagina->id_paquete; ?>"><p><?php echo  $nomp=$pagina->nombre_p; ?></p> </option> 

  <?php
      }
  ?>
</select>
                   </td>
                    <td>
                    <div class="col-md-10"></div>
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
</div>
</div>