<?php
include '../inc/config.php';
include '../inc/comun.php';

$bd = new GestarBD;

 echo $x1=$_GET['codigo'];




    if($_FILES["imagenprin"]!=""){
                    $ver="SELECT name_service,imagen FROM service WHERE id_service=$x1";
                    $bd->consulta($ver);
                    while ($fila=$bd->mostrar_registros()) { 
                                             $a=$fila->name_service;
                                             $b=$fila->imagen;

                                                             }
              if($a==""){
                  echo "se ha producido un error, primero  registra el titulo del proyecto en la pestaña datos basicos";
                        }
            if($b==""){
                          $reporte = null;
                          for($x=0; $x<count($_FILES["imagenprin"]["name"]); $x++)
                          {
                          $file = $_FILES["imagenprin"];
                          $nombre = $file["name"][$x];
                          $tipo = $file["type"][$x];
                          $ruta_provisional = $file["tmp_name"][$x];
                          $size = $file["size"][$x];
                          $width = $dimensiones[0];
                          $height = $dimensiones[1];
                          $carpeta = "../../producto/";

                               if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
                              {
                                 echo "<p style='color: red'>Error $nombre, el archivo no es una imagen  </p>";
                              }
                              else if($size > 1024*1024)// 1024*1024 = 1 MB
                              {
                                  echo "<p style='color: red'>Error $nombre, el tamaño máximo permitido es 1MB</p>";
                              }else{

                                 $gale="producto_";
                                 $name2=$gale.$a.$nombre;  
                                 $name3 = preg_replace('[\s+]','', $name2);
                                 $src = $carpeta.$name3;
                                 echo   move_uploaded_file($ruta_provisional, $src);
                                 $sql="UPDATE `service` SET `imagen` = '$name3' WHERE `service`.`id_service` = $x1";                 
                                 $bd->consulta($sql);
                                    }
                              }//fin for
                          }else{//fin de b=""

                                   $reporte = null;
                                     for($x=0; $x<count($_FILES["imagenprin"]["name"]); $x++)
                                    {
                                    $file = $_FILES["imagenprin"];
                                    $nombre = $file["name"][$x];
                                    $tipo = $file["type"][$x];
                                    $ruta_provisional = $file["tmp_name"][$x];
                                    $size = $file["size"][$x];
                                    

                                    $width = $dimensiones[0];
                                    $height = $dimensiones[1];
                                    $carpeta = "../producto/";

                                   if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
                                  {
                                     echo "<p style='color: red'>Error $nombre, el archivo no es una imagen  </p>";
                                  }
                                  else if($size > 1024*1024)// 1024*1024 = 1 MB
                                  {
                                      echo "<p style='color: red'>Error $nombre, el tamaño máximo permitido es 1MB</p>";
                                  }else
                                  {
                                     
                                       $gale="producto_";
                                 $name2=$gale.$a.$nombre;  
                                 $name3 = preg_replace('[\s+]','', $name2);
                                 $src = $carpeta.$name3;
                                  echo move_uploaded_file($ruta_provisional, $src);
                                 $sql="UPDATE `service` SET `imagen` = '$name3' WHERE `service`.`id_service` = $x1";                 
                                 $bd->consulta($sql);
                                  }
                                   }//fin for
                           }//fin else
}//fin edita fondo;


?>