
<?php

        if (isset($_GET['eliminar'])) { 

                 $x1=$_GET["codigo"];                    
                if( $x1=="" ){
                    echo "<script> alert('campos vacios')</script>";
                    echo "<br>";
                }else{
                                $sql3="delete from `accounts` where `accounts`.`id_accounts`='".$x1."'";
                                $bd->consulta($sql3);
                               

                   
                                            //echo "Datos Guardados Correctamente";
                                            echo '<div class="alert alert-success alert-dismissable">
                                                        <i class="fa fa-check"></i>
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Bien!</b> Se Elimino Correctamente... </div>';
                    }
        }


                if (isset($_GET['crear'])) { 



                         $banco = utf8_decode($_POST['banco']);
                         $pago = utf8_decode($_POST['pago']);
                         $propietario = utf8_decode($_POST['propietario']);
                         $numcuenta = utf8_decode($_POST['numcuenta']);
                         $numero = utf8_decode($_POST['numero']);
                         $correo = utf8_decode($_POST['correo']);


                               
                                 if( $banco==""  ){

                                    echo "
                   <script> alert('campos vacios')</script>
                   ";
                                    echo "<br>";
                                }else{

                                             $sql="INSERT INTO `accounts` (`id_accounts`, `name_accounts`, `tipe_accounts`, `num_accounts`, `name_bank_accounts`, `ci_accounts`, `mail_accounts`, `id_admin_accound`) VALUES (NULL, '$banco', '$pago', '$numcuenta', '$propietario', '$numero', '$correo', '1')";               
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
                          <a style=" margin-left: 10px;"  title="Registrar Nuevo" class="btn red btn-outline sbold " data-toggle="modal" href="#productoguarda">Nuevo </a> 
                          <a style=" margin-left: 10px;" class="btn red btn-outline sbold " title="Actualizar tabla" data-toggle="modal" href="?admin=plataformas"> <i class="fa fa-refresh" aria-hidden="true"></i> </a> 

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Lista De Plataformas de pago</span>
                                       
                                    </div>

                                    <div class="tools "> </div>
                                    
                                </div>

                                <div class="portlet-body">

                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th  class="all hidden-print">#</th>
                                                <th class="min-phone-l">Banco o Monedero</th>
                                                <th class="min-phone-l">Tipo de cuenta</th>
                                                <th class="min-phone-l">Propietario de cuenta</th>
                                                <th  class="min-phone-l hidden-print"> Opciones</th>
                                                <th class="none">numero de cuenta </th>
                                                <th class="none">Numero de Identificacion</th>
                                                <th class="none">email</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                     $consulta="SELECT * FROM `accounts` ORDER by id_accounts DESC";
                                         $bd->consulta($consulta);
                                      while ($fila=$bd->mostrar_registros()) { ?>
                                        <tr>    
                                        <?php $id= $fila->id_accounts; ?>

                                             <td  width="5%"><?php echo $fila->id_accounts; ?></td>
                                             <td  width="25%"> <?php echo $fila->name_bank_accounts; ?></td>
                                             <td  width="25%"><?php echo $fila->tipe_accounts; ?></td>
                                             <td  width="20%"><?php echo $fila->name_accounts; ?>  </td>
                                             <td width="25%" class="noprin">
                                                <center>
                                            
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline" data-toggle="modal" href="#productoedita"  title="Editar" id="buttonHola" onclick="myFunction2(this, '<?php echo $id ?>')" ><i class='fa fa-edit'></i> </a> 
                                                  <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline " data-toggle="modal" href="#productover"   title="ver" id="buttonHola" onclick="myFunction(this, '<?php echo $id ?>')" ><i class='fa fa-eye'></i></a>
                                                  <a  class="btn red btn-outline sbold derecha"  title="Eliminar" onclick='if(confirmDel() == false){return false;}' class="btn red btn-outline sbold"  href='?admin=plataformas&eliminar&codigo=<?php echo $id ?>'><i class=' fa fa-trash'></i></a>

                                                
                                                </center> 
                                             </td>
                                             <td><?php echo $fila->num_accounts; ?></td>
                                             <td><?php echo $fila->ci_accounts; ?></td>
                                             <td><?php echo $fila->mail_accounts; ?></td>
                                             
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
               

      
    

        
<!--modal guardar nuevo -->
        <div class="modal fade" id="productoguarda" tabindex="-1" role="basic" aria-hidden="true">
              <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border-bottom: 4px solid #2e77bc; background-color: #fff; color: #111;">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Registrar Nuevas Cuenta.</h4></h2>
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
                                    <form  role="form" action="?admin=plataformas&crear=crear" method="post" enctype="multipart/form-data">              
                                                        <th>Banco o Monedero </th>
                                                        <th>Tipo de cuenta</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input   required type="text" required name="banco" required class="form-control">
                                    </td>
                                    <td >
                                    <table>
                                      <tr>
                                        <td>
                                            <input type="radio" name="pago" value="ahorro"> Ahorro
                                            <input type="radio" name="pago" value="corriente"> Corriente
                                            <input type="radio" name="pago" value="paypal"> Paypal
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            <input type="radio" name="pago" value="bitcoin"> Bitcoin
                                            <input type="radio" name="pago" value="gitcar"> GitCard
                                            <input type="radio" name="pago" value="otro"> Otro
                                        </td>
                                      </tr>
                                    </table>
                                      
                                    </td>
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                                        <th>Propietario</th>
                                                        <th>Numero de Cuenta</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input class="form-control" type="text" name="propietario" />
                                    </td>
                                    <td width="50%" ><center>
                                      <input class="form-control"  type="text" name="numcuenta" />
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                <thead>
                                  <tr>
                                               
                                                        <th>Numero de Identificacion</th>
                                                        <th>Correo</th>
                                </thead>
                                <tbody>
                                  <tr> 
                                    <td width="50%"><center>
                                        <input class="form-control" type="text" name="numero" />
                                    </td>
                                    <td width="50%"><center>
                                      <center>
                                       <input class="form-control" type="email" name="correo" />
                                    </td>
                                    
                                  </tr>
                                </tbody>
                                 <tbody>
                                  <tr> 
                                    
                                    <td colspan="2" width="50%"><center>
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
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-eye"></i>&nbsp; Consultar Cuenta .</h4></h2>
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
                          <h2 class="modal-title" id="myModalLabel" style="font-size: 9pt;"><h4><i class="fa fa-edit"></i>&nbsp; Editar Cuenta.</h4></h2>
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
</div>
<script type="text/javascript" src="pages/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/plataformaspagos.js"></script>
