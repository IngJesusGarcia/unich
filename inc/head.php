
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

          $nombrelog  = $_SESSION['c3_nombre']  ?? '';
          $apellidolog = $_SESSION['c3_apellido'] ?? '';
          $maillog    = $_SESSION['c3_correo']   ?? '';
          if (!isset($_SESSION['c3_id']) || !is_numeric($_SESSION['c3_id'])) {
            die('ID de sesión inválido o no definido.');
        }
        
        $idlog = $_SESSION['c3_id'];
        $cilog      = $_SESSION['c3_ci']       ?? '';
          $phonelog   = $_SESSION['c3_phone']    ?? '';
          $hoy        = date("Y-m-d H:i:s");
          
                        

$consultaadmin="SELECT * FROM empresa INNER JOIN administrador ON administrador.id_administrador = empresa.id_admin_id_empresa 
                                 INNER JOIN user ON administrador.id_administrador = user.id_admin_id_user where id_admin_id_user=$idlog";
         $resultadoadmin =$bd-> consulta($consultaadmin); 
         if ($bd->numeroFilas() > 0 ) { 
            $bd->consulta($consultaadmin);
            while ($admin=$bd->mostrar_registros()) {
                                  $nameadmin= $admin->name_empresa; 
                                  $diradmin= $admin->dir_empresa; 
                                  $rifadmin= $admin->rif_empresa;  
                                  $logoadmin= $admin->logo_empresa;  
                                  $celadmin= $admin->tel_empresa;  
                                                    }
        
                                        }else{
                                 $nameadmin= "UNICH"; 
                                  $diradmin= "Corral de Piedra 2, 29299 San Cristóbal de las Casas, Chis."; 
                                  $rifadmin= "v-23134135";  
                                  $logoadmin= "logoc3.png";  
                                  $celadmin= "967 631 6151";  
  }

?>



<!DOCTYPE html>

<html lang="en">


    <head>
        <meta charset="utf-8" />
        <title><?php echo $nameadmin ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="expires" content="0">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        
       
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
       
        <link href="assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        
        <!-- END GLOBAL MANDATORY STYLES -->

<!-- tablas-->
  <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />



        

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
       
        
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color" />


        <!-- aniacion -->
        <link href="assets/animacion.css" rel="stylesheet" type="text/css" id="style_color" /> 

        <!-- opcional <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" /> 
        -->
        
        <script src="./ajax/jquery.min.js"></script>

        <!--libreria de hosting -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
        <!-- libreria rara -->
      <!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script> -->
        <link href="https://fonts.googleapis.com/css?family=Bungee|Cambo|Finger+Paint|Frijole|Shadows+Into+Light" rel="stylesheet">
      <!--  media queris-->
       <link href="assets/modalmovil.css" rel="stylesheet" type="text/css" /> 
</head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
