<?php

    session_start();

    if(isset($_SESSION["rol"]) && !empty($_SESSION['rol'])){

        require_once "../../conexion.php";

        if(!empty($_POST['id_usuario'])){

            $id_usuario=$_POST['id_usuario'];
            $sql="select * from usuario where id_usuario=?";
            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_usuario);
            if ($stmt->execute()){
                $result=$stmt->get_result();
                $fila=$result->fetch_assoc();
            }
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Editar usuario</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

                <!-- // -->
                <?php include("../../complementario/encabezado.php") ?>

                <section class="container mt-5">

                    <div class="text-center my-5 text text-primary">
                        <h3>Editar usuario</h3>
                    </div>
    
                    <div class="row text-center">
                            <?php
                                if($_SESSION['rol']=="vendedor"){
                            ?>
                        <form action="../../publico/acciones/usuarios/editar.php" method="post" class="p-5">

                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $fila['nombre']; ?>" required>
                                <label for="floatingPassword">Nombre</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $fila['apellido']; ?>" required>
                                <label for="floatingPassword">Apellido</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $fila['telefono']; ?>" required>
                                <label for="floatingPassword">Teléfono</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="direccion" value="<?php echo $fila['direccion']; ?>">
                                <label for="floatingPassword">Dirección</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="Contraseña" minlength="8" value="<?php echo $fila['password_hash'] ?>" required>
                                <label for="floatingPassword">Contraseña</label>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary p3 mt-5">Editar perfil</button>
                                <a href="lista.php" class="btn btn-danger p3 mt-5">Cancelar</a>
                            </div>
                        </form>
                            
                            <!-- // -->
                             <?php
                                }elseif($_SESSION['rol']=="admin"){
                             ?>

                        <form action="../../publico/acciones/usuarios/editar.php" method="post" class="p-2">

                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                             <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $fila['nombre']; ?>" required>
                                <label for="floatingPassword">Nombre</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $fila['apellido']; ?>" required>
                                <label for="floatingPassword">Apellido</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $fila['telefono']; ?>" required>
                                <label for="floatingPassword">Teléfono</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="direccion" value="<?php echo $fila['direccion']; ?>">
                                <label for="floatingPassword">Dirección</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="Contraseña" minlength="8" value="<?php echo $fila['password_hash']; ?>" required>
                                <label for="floatingPassword">Contraseña</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="<?php echo $fila['dni']; ?>" required>
                                <label for="floatingInput">DNI</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ejemplo@gmail.com" value="<?php echo $fila['email']; ?>" required>
                                <label for="floatingPassword">Email</label>
                            </div>

                            <div class="mb-5 col-12">
                                <select class="form-select" aria-label="Default select example" id="rol" name="rol">
                                <option selected value="<?php echo $fila['rol']; ?>">Rol</option>
                                <option value="admin">Admin</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="pendiente">Pendiente</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary p3 mt-5">Editar perfil</button>
                                <a href="lista.php" class="btn btn-danger p3 mt-5">Cancelar</a>
                            </div>

                            <?php
                                } else{
                                    header("Location: ../../complementario/error404.php");
                                }
                                exit;
                            ?>

                        </form>

                <!-- // -->
                <?php
                if (isset($_GET["mensaje"])){
                    echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                }
                ?>
                </div>
            </section>

<!-- // -->
<?php
        //admin
        } elseif($_SESSION['rol']=="admin"){
?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Agregar usuario</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            <body>

                <!-- // -->
                <?php include("../../complementario/encabezado.php") ?>

                <section class="container mt-5">

                <div class="text-center my-5 text text-primary">
                    <h3>Crear usuario</h3>
                </div>
                
                    <div class="row text-center">
                        <form action="../../publico/acciones/usuarios/crear.php" method="post" class="p-5">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                <label for="floatingPassword">Nombre</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                                <label for="floatingPassword">Apellido</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" required>
                                <label for="floatingInput">DNI</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                                <label for="floatingPassword">Teléfono</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="direccion">
                                <label for="floatingPassword">Dirección</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ejemplo@gmail.com" required>
                                <label for="floatingPassword">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="Contraseña" required>
                                <label for="floatingPassword">Contraseña</label>
                            </div>

                            <div class="mb-5 col-12">
                                <select class="form-select" aria-label="Default select example" id="rol" name="rol">
                                <option selected value="<?php echo $fila['rol']; ?>">Rol</option>
                                <option value="admin">Admin</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="pendiente">Pendiente</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary p3 mt-5">Editar perfil</button>
                                <a href="lista.php" class="btn btn-danger p3 mt-5">Cancelar</a>
                            </div>
                        </form>
                    </div>

                    <!-- // -->
                    <?php
                    if (isset($_GET["mensaje"])){
                        if ($_GET["mensaje"]!="ok"){
                            echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                        } else{
                            echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Beneficio editado</strong></div></div>";
                        }
                    }
        } else{
            header("Location: ../../complementario/error404.php");
        }
        ?>
                    </div>
                </section>

<!-- // -->
<?php
}else{
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Crear usuario</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

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
                            <a href="http://localhost/sistema_beneficios/vistas/sesion/login.php" class="btn btn-dark ms-auto button-nav">Iniciar sesion</a>
                        </div>
                    </div>
                </nav>

                <section class="container mt-5">
                    
                    <div class="shadow div-form">
                        <h3>Registrarse</h3>
                        <form action="../../publico/acciones/usuarios/crear.php" method="post" class="p-5 row">

                            
                            <div class="mb-3 col-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control input" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            
                            <div class="mb-3 col-4">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control input" id="apellido" name="apellido" placeholder="Apellido" required>
                            </div>
                            
                            <div class="mb-3 col-2">
                                <label class="form-label">DNI</label>
                                <input type="number" class="form-control input" id="dni" name="dni" placeholder="DNI" pattern="[0-9]{8}" required>
                            </div>
                            
                            <div class="mb-3 col-5">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control input" id="telefono" name="telefono" placeholder="Telefono" required>
                            </div>
                            
                            <div class="mb-3 col-7">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control input" id="direccion" name="direccion" placeholder="Direccion">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control input" id="email" name="email" placeholder="Ejemplo@gmail.com" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control input" id="password_hash" name="password_hash" placeholder="Contraseña" minlength="8" required>
                            </div>
                            <input type="hidden" class="form-control" id="rol" name="rol" value="pendiente">
                            
                            <button type="submit" class="btn button-confirm col-2 p3 mt-5">Registrar usuario</button>
                            <a href="../inicio.php" class="btn button-cancel col-2 p3 ms-auto mt-5">Cancelar</a>
                        </form>
                    </div>
                    <!-- // -->
                    <?php
                    if (isset($_GET["mensaje"])){
                        if ($_GET["mensaje"]!="ok"){
                            echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                        } else{
                            echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Usuario creado</strong></div></div>";
                        }
                    }
                    ?>
                    </div>
                </section>
<!-- // -->
<?php
    }
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>