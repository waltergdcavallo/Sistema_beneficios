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

                <section class="container my-5">
                    <div class="div-form shadow p-4 p-md-5">
                
                        <div class="text-center mb-4 text text-primary">
                            <h3>Editar usuario</h3>
                        </div>
                
                        <?php if ($_SESSION['rol'] == 'vendedor'){ ?>
                
                            <form action="../../publico/acciones/usuarios/editar.php" method="post" class="row g-3">
                
                                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                
                                <div class="col-12 col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $fila['nombre']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $fila['apellido']; ?>" required>
                                    <label for="apellido" class="form-label">Apellido</label>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo $fila['telefono']; ?>" required>
                                    <label for="telefono" class="form-label">Teléfono</label>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<?php echo $fila['direccion']; ?>">
                                    <label for="direccion" class="form-label">Dirección</label>
                                </div>
                
                                <div class="col-12">
                                    <input type="password" class="form-control" id="password" name="password_hash" placeholder="Contraseña" minlength="8" value="<?php echo $fila['password_hash']; ?>" required>
                                    <label for="password" class="form-label">Contraseña</label>
                                </div>
                
                                <div class="col-12 d-flex justify-content-between align-items-center mt-4 pt-2">
                                    <button type="submit" class="btn btn-confirm col-5 col-md-2">Editar perfil</button>
                                    <a href="../inicio.php" class="btn btn-cancel col-5 col-md-2 text-center ms-auto">Cancelar</a>
                                </div>
                
                            </form>
                
                        <?php }elseif ($_SESSION['rol'] == 'admin'){ ?>
                
                            <form action="../../publico/acciones/usuarios/editar.php" method="post" class="row g-3">
                
                                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                
                                <div class="col-12 col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $fila['nombre']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $fila['apellido']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo $fila['telefono']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<?php echo $fila['direccion']; ?>">
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password_hash" placeholder="Contraseña" minlength="8" value="<?php echo $fila['password_hash']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="<?php echo $fila['dni']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ejemplo@gmail.com" value="<?php echo $fila['email']; ?>" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="rol" class="form-label">Rol asignado</label>
                                    <select class="form-select" id="rol" name="rol" required>
                                        <option value="admin" <?php echo ($fila['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="vendedor" <?php echo ($fila['rol'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                        <option value="pendiente" <?php echo ($fila['rol'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                    </select>
                                </div>
                
                                <div class="col-12 d-flex justify-content-between align-items-center mt-4 pt-2">
                                    <button type="submit" class="btn btn-confirm col-5 col-md-2">Editar perfil</button>
                                    <a href="lista.php" class="btn btn-cancel col-5 col-md-2 text-center ms-auto">Cancelar</a>
                                </div>
                
                            </form>
                
                        <?php }else{ ?>
                            <script>window.location.href = "../../complementario/error404.php";</script>
                        <?php } ?>
                
                    </div>
                
                    <?php if (isset($_GET['mensaje'])){ ?>
                            <div class="container mt-4">
                                <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Éxito!</strong> El usuario fue creado correctamente.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }elseif ($_GET['mensaje'] == 'editado'){ ?>
                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Actualizado!</strong> El registro fue editado correctamente.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }elseif ($_GET['mensaje'] == 'error1'){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Error!</strong> Hubo un problema al procesar la creación o edición. Inténtalo de nuevo.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } elseif ($_GET['mensaje'] == 'error2'){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Error!</strong> Faltan datos.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                </section>

    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

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

                <section class="container my-5">
                    <div class="div-form shadow p-4 p-md-5">
                
                        <div class="text-center mb-4 text text-primary">
                            <h3>Crear usuario</h3>
                        </div>
                
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'){ ?>
                
                            <form action="../../publico/acciones/usuarios/crear.php" method="post" class="row g-3">
                
                                <div class="col-12 col-md-4">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control input shadow-sm" id="nombre" name="nombre" placeholder="Nombre" required>
                                </div>
                
                                <div class="col-12 col-md-4">
                                    <label for="apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control input shadow-sm" id="apellido" name="apellido" placeholder="Apellido" required>
                                </div>
                
                                <div class="col-12 col-md-4">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control input shadow-sm" id="dni" name="dni" placeholder="DNI" required minlength="8">
                                </div>
                
                                <div class="col-12 col-md-4">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control input shadow-sm" id="telefono" name="telefono" placeholder="Teléfono" required>
                                </div>
                
                                <div class="col-12 col-md-4">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control input shadow-sm" id="direccion" name="direccion" placeholder="Dirección">
                                </div>
                
                                <div class="col-12 col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control input shadow-sm" id="email" name="email" placeholder="Ejemplo@gmail.com" required>
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="password_hash" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control input shadow-sm" id="password_hash" name="password_hash" placeholder="Contraseña" required minlength="8">
                                </div>
                
                                <div class="col-12 col-md-6">
                                    <label for="rol" class="form-label">Rol</label>
                                    <select class="form-select input shadow-sm" id="rol" name="rol" required>
                                        <option value="" disabled selected>Elija un Rol</option>
                                        <option value="admin">Admin</option>
                                        <option value="vendedor">Vendedor</option>
                                        <option value="pendiente">Pendiente</option>
                                    </select>
                                </div>
                
                                <div class="col-12 d-flex justify-content-between align-items-center mt-4 pt-2">
                                    <button type="submit" class="btn btn-confirm col-5 col-md-2">Agregar</button>
                                    <a href="lista.php" class="btn btn-cancel col-5 col-md-2 text-center ms-auto">Cancelar</a>
                                </div>
                
                            </form>
                
                        <?php }else{ ?>
                            <script>window.location.href = "../../complementario/error404.php";</script>
                        <?php } ?>
                
                    </div>
                
                    <?php if (isset($_GET['mensaje'])){ ?>
                           <div class="container mt-4">
                               <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                   <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                       <strong>¡Éxito!</strong> El usuario fue creado correctamente.
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                               <?php }elseif ($_GET['mensaje'] == 'editado'){ ?>
                                   <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                       <strong>¡Actualizado!</strong> El registro fue editado correctamente.
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                               <?php }elseif ($_GET['mensaje'] == 'error1'){ ?>
                                   <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                       <strong>¡Error!</strong> Hubo un problema al procesar la creación o edición. Inténtalo de nuevo.
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                                <?php } elseif ($_GET['mensaje'] == 'error2'){ ?>
                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Error!</strong> Faltan datos.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php  }?> 
                </section>

    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!-- // -->
<?php
    }else{
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registrarse</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand btn-nav-title" href="http://localhost/sistema_beneficios/vistas/inicio.php">Sistema de beneficios</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse me-2" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="btn btn-dark btn-nav" aria-current="page" href="http://localhost/sistema_beneficios/vistas/inicio.php">inicio</a>
                                </li>
                            </ul>
                            <a href="http://localhost/sistema_beneficios/vistas/sesion/login.php" class="btn btn-dark ms-auto btn-nav">Iniciar sesion</a>
                        </div>
                    </div>
                </nav>

                <section class="container mt-5">
                    <div class="shadow div-form">
                        <h3 class="ps-5">REGISTRARSE</h3>
                        <form action="../../publico/acciones/usuarios/crear.php" method="post" class="p-5 row">

                            <div class="mb-4 col-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control input shadow" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            
                            <div class="mb-4 col-4">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control input shadow" id="apellido" name="apellido" placeholder="Apellido" required>
                            </div>
                            
                            <div class="mb-4 col-4">
                                <label class="form-label">DNI</label>
                                <input type="number" class="form-control input shadow" id="dni" name="dni" placeholder="DNI" pattern="[0-9]{8}" required>
                            </div>
                            
                            <div class="mb-4 col-4">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control input shadow" id="telefono" name="telefono" placeholder="Telefono" required>
                            </div>
                            
                            <div class="mb-4 col-6">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control input shadow" id="direccion" name="direccion" placeholder="Direccion">
                            </div>
                            
                            <div class="mb-4 col-5">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control input shadow" id="email" name="email" placeholder="Ejemplo@gmail.com" required>
                            </div>
                            
                            <div class="mb-4 col-6">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control input shadow" id="password_hash" name="password_hash" placeholder="Contraseña" minlength="8" required>
                            </div>
                            <input type="hidden" class="form-control" id="rol" name="rol" value="pendiente">
                            
                            <button type="submit" class="btn btn-confirm col-2 p3 mt-5">Registrarse</button>
                            <a href="../inicio.php" class="btn btn-cancel col-2 p3 ms-auto mt-5">Cancelar</a>
                        </form>
                    </div>
                </section>
    <!-- // -->
    <div class="m-4 p-4"></div>
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<!-- // -->
<?php
}
?>