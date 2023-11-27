<?php

require_once(__DIR__ . '/../Session.php');
require_once(__DIR__ . '/../HTMLPage.php');
require_once('includes/header.php');

// Crear una instancia de la clase Session
$session = new Session();

// Crear una instancia de la clase HTMLPage
$htmlPage = new HTMLPage('Panel de Administración', [
        "../assets/js/all.min.js",
    "../assets/css/material-dashboard.css",
    "../assets/css/dataTables.bootstrap4.min.css",
    "../assets/js/jquery-ui/jquery-ui.min.css",
    "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css",
    "../assets/css/styles.css",


]);

$htmlPage->start();
?>

<script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="https://raw.githubusercontent.com/Pulgarcit0/Pasteleria_Sys/main/img/pexels-eric-mufasa-1414234.jpg">
            <div class="logo"><a href="./" class="simple-text logo-normal">
                    Mtz
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="usuarios.php">
                            <i class="fas fa-user mr-2 fa-2x"></i>
                            <p> Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="config.php">
                            <i class="fas fa-cogs mr-2 fa-2x"></i>
                            <p> Configuraciónes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="productos.php">
                            <i class="fab fa-product-hunt mr-2 fa-2x"></i>
                            <p> Productos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="clientes.php">
                            <i class=" fas fa-users mr-2 fa-2x"></i>
                            <p> Clientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="ventas.php">
                            <i class="fas fa-cash-register mr-2 fa-2x"></i>
                            <p> Nueva_Venta</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="lista_ventas.php">
                            <i class="fas fa-cart-plus mr-2 fa-2x"></i>
                            <p> Historial Ventas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="Bus_Emp.php">
                            <i class="fas fa-user mr-2 fa-2x"></i>
                            <p> Buscador</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" href="Empledos.php">
                            <i class="fas fa-user mr-2 fa-2x"></i>
                            <p> Empleados</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top bg-transparent navbar-with-background-image">
                <div class="container-fluid""> <!-- Ajusta el valor de max-width según tu preferencia -->

                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:;">Sistema de Venta</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                    <p class="d-lg-none d-md-block">
                                        Cuenta
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevo_pass">Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="salir.php">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->


            <div class="content">
                <div class="container-fluid">