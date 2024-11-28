<!-- Sidebar -->


<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo mt-4">
                <img src="../img/logo-pagina-principal.png" alt="logo" width="200px" height="75px">
                <!-- <img
                    src="../../img/iniciar-sesion.png"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" /> -->
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a
                        data-bs-toggle="collapse"
                        href="#dashboard"
                        class="collapsed"
                        aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                    <a href="<?php echo getUrl("Usuarios","Usuarios","getUpdate",array("usu_id"=>$_SESSION['id'])); ?>">
                                    <span class="sub-item">MAPA </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section"><?php echo $_SESSION["Nombre"]." ".$_SESSION["Apellido"]?></h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Usuarios</p>
                        <span class="caret"></span>
                    </a>    
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo getUrl("Usuarios", "Usuarios", "getUsuarios"); ?>">
                                    <span class="sub-item" >Lista usuarios</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Lista Reportes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Solicitudes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo getUrl("Accidentes", "Accidentes", "getCreate"); ?>">
                                    <span class="sub-item">Accidentes</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo getUrl("Reductores", "Reductores", "getCreate"); ?>">
                                    <span class="sub-item">Reductores de velocidad</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo getUrl("Señalizacion", "Señalizacion", "getCreate"); ?>">
                                    <span class="sub-item">Señalización vial</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo getUrl("Vial", "Vial", "getCreate"); ?>">
                                    <span class="sub-item">Malla vial</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->