<div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="?mod=principal">
                        <img src="./img/<?php echo  $logoadmin; ?>"  alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                     <?php if(isset($_SESSION["products"])!=""){
                                        ?>
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                               <i class="icon-basket"></i>
                                <span class="username username-hide-on-mobile">Compras </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="?mod=view_cart">
                                        <i class="icon-basket"></i>Servicios en Carro
                                        <span class="badge badge-success"> <?php 
                                    if(isset($_SESSION["products"])){
                                        echo count($_SESSION["products"]); 
                                    }else{
                                        echo 0; 
                                    }
                                    ?> </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                          <?php
                                    } ?>
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="./logout.php" onclick="window.location = './logout.php'" class="dropdown-toggle">
                                <i class="icon-logout"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">        
            <div class="page-sidebar-wrapper">            
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                     
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler"> </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="?mod=principal" class="nav-link nav-toggle">
                                <i class="icon-wrench"></i>
                                <span class="title">Opciones Principales</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                             <li class="nav-item start ">
                                    <a href="?mod=principal" class="nav-link ">
                                        <i class="fa fa-home"></i>
                                        <span class="title">INICIO</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="?mod=services" class="nav-link ">
                                        <i class="fa fa-paper-plane-o"></i>
                                        <span class="title">Solicitar Productos</span>
                                    </a>
                                </li>
                                 <li class="nav-item start ">
                                    <a href="?mod=facturas" class="nav-link ">
                                        <i class="fa fa-ticket"></i>
                                        <span class="title">Recibos</span>
                                    </a>
                                </li>
                                 <li class="nav-item start ">
                                    <a href="?mod=administrador" class="nav-link ">
                                        <i class="fa fa-cog"></i>
                                        <span class="title">Configuaración</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="page-content-wrapper">
          
                <div class="page-content">
      