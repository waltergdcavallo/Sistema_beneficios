<?php

    //admin

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']=="admin"){

        require_once "../../conexion.php";
        $sql="SELECT *, concat(nombre, ' ', apellido) AS nombreyapellido FROM usuario ORDER BY id_usuario DESC";
        $stmt=$conex->prepare($sql);
        if ($stmt->execute()){
            $resultado=$stmt->get_result();
        }

?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Listado de Usuarios</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <link rel="stylesheet" href="../../sass/main.css">
        </head>
        <body>

            <?php include("../../complementario/encabezado.php") ?>

            <div class="text-center">
                <div class="text-center my-5">
                    <h3 class="title-list">Listado de Usuarios</h3>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="col-2 section-list">
                            <a href="../inicio.php" class="btn btn-primary">Regresar al inicio</a>
                        </div>
                        <div class="col-8"></div>
                        <div class="col-2 section-list">
                            <a href="form.php" class="btn btn-primary">Agregar</a>
                        </div>
                    </div>

                <section class="section-list">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y apellido</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Ventas</th>
                                <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                    <tbody>
    
                            <!-- // -->
                            <?php
                                if($resultado->num_rows>0){
                                    while($fila=$resultado->fetch_assoc()){
    
                            ?>
                                        <tr>
                                            <td><?php echo $fila["nombreyapellido"]; ?></td>
                                            <td><?php echo $fila["dni"]; ?></td>
                                            <td><?php echo $fila["email"]; ?></td>
                                            <td><?php echo$fila["rol"];?></td>
                                            <td>
                                                <div class="d-sm-inline-block">
                                                    <form action="../ventas/lista.php" method="post">
                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $fila["id_usuario"];?>">
                                                        <button type="submit" class="btn btn-link">Ver ventas</button>
                                                    </form>
                                                </div>
                                            </td> 
                                            <td>
                                                <div class="d-sm-inline-block">
                                                    <form action="detalle.php" method="post">
                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $fila["id_usuario"];?>">
                                                        <button class="btn btn-primary p-1" type="submit">Ver Detalle</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
    
                            <!-- // -->
                            <?php
                                }
                            }else{
                            ?>
                                <tr>
                                    <td scope="5"></td>
                                    <div class="text-center alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">No existen Usuarios en la tabla</div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- // -->
                    <?php if (isset($_GET['mensaje'])){ ?>
                            <div class="container mt-4">
                                <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Éxito!</strong> El usuario fue creado correctamente.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }elseif ($_GET['mensaje'] == 'editado'){ ?>
                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Actualizado!</strong> El usuario fue editado correctamente.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }elseif ($_GET['mensaje'] == 'eliminado'){ ?>
                                    <div class="alert alert-warning alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                        <strong>¡Eliminado!</strong> El usuario fue eliminado correctamente.
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
            </div>
        </div>

    <div class="m-5 p-5"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

<!-- // -->
<?php

    //vendedor y pendiente
    } else{
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>