<?php
include 'inc/config.php'; // conexión y clases
$bd = new GestarBD();



// Total de salidas
$total_salidas = 0;
$bd->consulta("SELECT SUM(cantida_salida) AS total FROM salida");
if ($fila = $bd->mostrar_registros()) {
    $total_salidas = $fila->total ?? 0;}

// Total de productos
$consulta_productos = "SELECT SUM(cantida) as total_productos FROM service";
$bd->consulta($consulta_productos);
$fila = $bd->mostrar_registros();
$total_productos = number_format($fila->total_productos, 0);
?>
                 
                 <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-chevron-circle-up fa-icon-medium"></i>
                                </div>
                                <div class="details">
                                <div class="number"><?php echo number_format($total_salidas); ?></div>
                <div class="desc"> Salidas </div>
                                </div>
                                <a class="more" href="?admin=salida"> Ver Todos
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart fa-icon-medium"></i>
                                </div>
                                <div class="details">
                                <div class="number"> <?php echo $total_productos; ?> </div>
                                <div class="desc"> Productos </div>
                                </div>
                                <a class="more" href="?admin=productos"> Ver Todos
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Begin: life time stats -->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-blue"></i>
                                        <span class="caption-subject font-blue bold uppercase">Entradas</span>
                                        <span class="caption-helper">reportes...</span>
                                    </div>
                                   
                                </div>
                                <div class="portlet-body">
                              
                                <div id="chartContainer" style="height: 300px; width: 100%;">
                                              
                                              </div>

                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                        <div class="col-md-6">
                            <!-- Begin: life time stats -->
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-red"></i>
                                        <span class="caption-subject font-red bold uppercase">Salidas</span>
                                        <span class="caption-helper">reportes...</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_ecommerce_tab_1">
                                        <div id="chartContainer2" style="height: 300px; width: 100%;">

                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                        
                    </div>
                    
                </div>
                <!-- END CONTENT BODY -->
            </div>
           
      <!--  grafica 1-->
      <script type="text/javascript" src="assets/graficas/canvasjs.min.js"></script>
      <script type="text/javascript" src="js/graficas.js"></script>
   





    
 