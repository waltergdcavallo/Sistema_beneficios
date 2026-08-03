<?php

    session_start();

    if(isset($_SESSION["rol"]) && !empty($_SESSION['rol'])){
        header ("Location:http://localhost/sistema_beneficios/vistas/inicio.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../sass/main.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-2" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                    </li>
                </ul>
                <a href="http://localhost/sistema_beneficios/vistas/usuarios/form.php" class="btn btn-dark ms-auto">Registrarse</a>
            </div>
        </div>
    </nav>
   
    <section>
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <div class="mt-5 text-center"><h3>Inicio de Sesión</h3></div>
                    <form action="../../publico/acciones/sesion/acceso.php" method="post">
                    <div class="mb-3">
                      <label for="dni" class="form-label"> Email:</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="ejemplo@gmail.com" required>
                    </div>

                    <div class="mb-3">
                      <label for="clave" class="form-label">Contraseña:</label>
                      <input type="password" class="form-control" name="password_hash" id="password_hash" minlength="8" placeholder="Ingresa la contraseña" required>
                    </div>

                    <div class="text-center mt-5 pt-5"><button type="submit" class="btn button-cancel" name="btn_ingresar" id="btn_ingresar">Ingresar</button></div>
                    </form>

  
  <?php
    
            if (isset($_SESSION["error"])){

                echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".htmlspecialchars($_SESSION["error"])."</strong></div></div>"; 

              unset($_SESSION["error"]);
            }
  ?> 
                    <div class="col-12 col-md-2"></div>
                </div>
            </div>
        </div>
    </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>