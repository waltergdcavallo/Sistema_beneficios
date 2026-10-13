<?php

    session_start();

    if (isset($_SESSION['rol']) && !empty($_SESSION['rol'])){

        if(!empty($_POST['id_usuario']) && $_SESSION['rol']=="admin"){

            require_once "../../conexion.php";
            $id_usuario=$_POST["id_usuario"];
            $sql="select *, concat(nombre, ' ', apellido) as nombreyapellido from usuario where id_usuario=?";
            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_usuario);
            if($stmt->execute()){
                $resultado=$stmt->get_result();
                $fila=$resultado->fetch_assoc();
            }
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>
                    Detalles del usuario
                </title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

                <!-- // -->
                <?php include("../../complementario/encabezado.php") ?>

                <section class="container section-detail my-5">

                    <div class="text-center mb-4">
                        <h3 class="detail-title">Usuario</h3>
                    </div>
                
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label for="nombreyapellido" class="form-label">Nombre y Apellido</label>
                            <input class="form-control" type="text" id="nombreyapellido" value="<?php echo $fila['nombreyapellido']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="dni" class="form-label">Dni</label>
                            <input class="form-control" type="text" id="dni" value="<?php echo $fila['dni']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input class="form-control" type="text" id="telefono" value="<?php echo $fila['telefono']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" value="<?php echo $fila['email']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input class="form-control" type="text" id="direccion" value="<?php echo $fila['direccion']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="rol" class="form-label">Rol</label>
                            <input class="form-control" type="text" id="rol" value="<?php echo $fila['rol']; ?>" disabled>
                        </div>
                    </div>
                
                    <div class="detail-actions d-flex flex-wrap justify-content-between align-items-center gap-3 mt-5 pt-4">
                        <?php if($fila['rol']!="pendiente"){?>
                        <form action="../historial/lista.php" method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                            <button class="btn btn-view" type="submit">Beneficios asociados</button>
                        </form>
                        <?php }?>
                
                        <form action="form.php" method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                            <button class="btn btn-edit" type="submit">Editar</button>
                        </form>
                
                        <form action="../../publico/acciones/usuarios/eliminar.php" method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                            <button class="btn btn-del" type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</button>
                        </form>
                    </div>

                </section>
                
                <section class="container">
                    <div class="row">
                        <div class="col-2 section-list">
                            <a href="../inicio.php" class="btn btn-primary">Regresar al inicio</a>
                        </div>
                    </div>
                </section>

                <?php if (isset($_GET['mensaje'])){ ?>
                        <div class="container mt-4">
                            <?php if ($_GET['mensaje'] == 'editado'){ ?>
                                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                    <strong>¡Actualizado!</strong> El perfil fue editado correctamente.
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

    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>      
</body>    
</html>
<!-- // -->
<?php 
        }elseif($_SESSION['rol']=="admin" || $_SESSION['rol']=="vendedor" || $_SESSION['rol']=="pendiente"){
?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>
                    Perfil del usuario
                </title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

                <!-- // -->
                <?php include("../../complementario/encabezado.php") ?>

                <section class="container section-detail shadow my-5">

                    <div class="text-center mb-4">
                        <h3 class="detail-title">Mi perfil</h3>
                    </div>
                
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label for="nombreyapellido" class="form-label">Nombre y Apellido</label>
                            <input class="form-control" type="text" id="nombreyapellido" value="<?php echo $_SESSION['nombreyapellido']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="dni" class="form-label">Dni</label>
                            <input class="form-control" type="text" id="dni" value="<?php echo $_SESSION['dni']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input class="form-control" type="text" id="telefono" value="<?php echo $_SESSION['telefono']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input class="form-control" type="text" id="direccion" value="<?php echo $_SESSION['direccion']; ?>" disabled>
                        </div>
                
                        <div class="col-12 col-md-6">
                            <label for="rol" class="form-label">Rol</label>
                            <input class="form-control" type="text" id="rol" value="<?php echo $_SESSION['rol']; ?>" disabled>
                        </div>
                    </div>
                
                    <div class="detail-actions d-flex justify-content-between align-items-center mt-5 pt-4">
                        <form action="form.php" method="post">
                            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                            <button class="btn btn-edit" type="submit">Editar</button>
                        </form>
                        <a href="../inicio.php" class="btn btn-del">Regresar</a>
                    </div>

                </section>

                <?php if (isset($_GET['mensaje'])){ ?>
                        <div class="container mt-4">
                            <?php if ($_GET['mensaje'] == 'editado'){ ?>
                                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                    <strong>¡Actualizado!</strong> El perfil fue editado correctamente.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php }elseif ($_GET['mensaje'] == 'error'){ ?>
                                <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                    <strong>¡Error!</strong> Hubo un problema al procesar la creación o edición. Inténtalo de nuevo.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>      
</body>    
</html>
<?php
        }else{
            header("Location: ../../complementario/error404.php");
        }
        exit;
        
    }else{
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>