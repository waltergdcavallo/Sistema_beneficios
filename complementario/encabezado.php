<header>
  
<!-- // -->
<?php

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol'])){
  
        //admin
        if($_SESSION['rol']=="admin"){

?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand button-nav-title" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-dark button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/usuarios/lista.php">listado de usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/beneficios/lista.php">listado de beneficios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/ventas/lista.php">lista de ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/productos/lista.php">lista de productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/historial/lista.php">Historial</a>
                            </li>
                        </ul>
                        <a class="btn btn-dark ms-auto button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/usuarios/detalle.php">perfil</a>
                        <a class="btn btn-dark ms-1 button-nav" aria-current="page" href="http://localhost/sistema_beneficios/publico/acciones/sesion/salir.php">Salir</a>
                    </div>
                </div>
            </nav>


<!-- // -->
<?php
        //vendedor
        }elseif($_SESSION['rol']=="vendedor"){
?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand button-nav-title" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-dark button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/beneficios/detalle.php">beneficios</a>
                            </li>
                        </ul>
                        <a class="btn btn-dark ms-auto button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/ventas/lista.php">mis ventas</a>
                        <a class="btn btn-dark ms-1 button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/usuarios/detalle.php">perfil</a>
                        <a class="btn btn-dark ms-1 button-nav" aria-current="page" href="http://localhost/sistema_beneficios/publico/acciones/sesion/salir.php">salir</a>
                    </div>
                </div>
            </nav>
<!-- // -->
<?php
        //pendiente
        }elseif($_SESSION['rol']=="pendiente"){
?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand button-nav-title" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-dark button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                            </li>
                        </ul>
                        <a class="btn btn-dark ms-auto button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/usuarios/detalle.php">perfil</a>
                        <a class="btn btn-dark ms-1 button-nav" aria-current="page" href="http://localhost/sistema_beneficios/publico/acciones/sesion/salir.php">salir</a>
                    </div>
                </div>
            </nav>
<!-- // -->
<?php
        }
        //no logueado
}else {
?>
    <head>
        <link rel="stylesheet" href="../sass/main.css">
    </head>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand button-nav-title" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-2" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-dark button-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                    </li>
                </ul>
                <a href="http://localhost/sistema_beneficios/vistas/usuarios/form.php" class="btn btn-dark ms-auto button-nav">Registrarse</a>
                <a href="http://localhost/sistema_beneficios/vistas/sesion/login.php" class="btn btn-dark ms-2 button-nav">Ingresar</a>
            </div>
        </div>
    </nav>


<?php } ?>
</header>
    
    