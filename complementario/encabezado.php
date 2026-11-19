<header>
  
<!-- // -->
<?php

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol'])){
  
        //admin
        if($_SESSION['rol']=="admin"){
            require_once "../conexion.php";

?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand btn-nav-title" href="h<?= BASE_URL ?>/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/inicio.php">Inicio</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/usuarios/lista.php">Listado de usuarios</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/beneficios/lista.php">Listado de beneficios</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/ventas/lista.php">Lista de ventas</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/productos/lista.php">Lista de productos</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/historial/lista.php">Historial</a>
                            </li>
                        </ul>
                        <a class="btn ms-auto btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/usuarios/detalle.php">Perfil</a>
                        <a class="btn ms-1 btn-nav" aria-current="page" href="<?= BASE_URL ?>/publico/acciones/sesion/salir.php">Salir</a>
                    </div>
                </div>
            </nav>


<!-- // -->
<?php
        //vendedor
        }elseif($_SESSION['rol']=="vendedor"){
            require_once "../conexion.php";
?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand btn-nav-title" href="<?= BASE_URL ?>/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/inicio.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/beneficios/lista.php">Beneficios</a>
                            </li>
                        </ul>
                        <form action="<?= BASE_URL ?>/vistas/ventas/lista.php" method="POST">
                            <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                            <button type="submit" class="btn btn-nav" aria-current="page">Mis ventas</button>
                        </form>
                        <a class="btn ms-auto btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/usuarios/detalle.php">Perfil</a>
                        <a class="btn ms-1 btn-nav" aria-current="page" href="<?= BASE_URL ?>/publico/acciones/sesion/salir.php">Salir</a>
                    </div>
                </div>
            </nav>
<!-- // -->
<?php
        //pendiente
        }elseif($_SESSION['rol']=="pendiente"){
            require_once "../conexion.php";
?>
            <head>
                <link rel="stylesheet" href="../sass/main.css">
            </head>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand btn-nav-title" href="<?= BASE_URL ?>/vistas/inicio.php">Sistema de beneficios</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse me-2" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-dark btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/inicio.php">Inicio</a>
                            </li>
                        </ul>
                        <a class="btn btn-dark ms-auto btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/usuarios/detalle.php">Perfil</a>
                        <a class="btn btn-dark ms-1 btn-nav" aria-current="page" href="<?= BASE_URL ?>/publico/acciones/sesion/salir.php">Salir</a>
                    </div>
                </div>
            </nav>
<!-- // -->
<?php
        }
        //no logueado
}else {
    require_once "../conexion.php";
?>
    <head>
        <link rel="stylesheet" href="../sass/main.css">
    </head>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand btn-nav-title" href="<?= BASE_URL ?>/vistas/inicio.php">Sistema de beneficios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-2" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-dark btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/inicio.php">Inicio</a>
                    </li>
                </ul>
                <a class="btn btn-dark ms-auto btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/usuarios/form.php">Registrarse</a>
                <a class="btn btn-dark ms-2 btn-nav" aria-current="page" href="<?= BASE_URL ?>/vistas/sesion/login.php">Ingresar</a>
            </div>
        </div>
    </nav>


<?php } ?>
</header>
    
    