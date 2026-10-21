<?php

    //admin y vendedor

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']!=="pendiente"){

        require_once "../../conexion.php";

            if(!empty($_POST['id_usuario'])){

                $id_usuario=$_POST['id_usuario'];

                $sql="select venta.*, concat(usuario.nombre, ' ', usuario.apellido) as nombreyapellido from venta, usuario where venta.id_usuario=? group by venta.id_venta";

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
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Listado de ventas</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../sass/main.css">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <div class="text-center">
                        <div class="text-center my-5 text text-primary">
                            <h3 class="title-list"><?php if(isset($fila['nombreyapellido'])){echo "Ventas de: ".$fila['nombreyapellido'];}else{ echo "Este usuario no tiene ventas";}?></h3>
                        </div>
                    
                        <section class="container">
                            <div class="row">
    
                                <div class="col-2 section-list">
                                    <a href="../inicio.php" class="btn btn-primary">Regresar al inicio</a>
                                </div>
                                <div class="col-8"></div>
                                <div class="col-2 section-list">
                                    <a href="form.php" class="btn btn-primary">Agregar</a>
                                </div>
    
                                <!-- // -->
                                <?php if (isset($_GET['mensaje'])){ ?>
                                    <div class="container mt-4">
                                        <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                <strong>¡Éxito!</strong> La venta fue creada correctamente.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php }elseif ($_GET['mensaje'] == 'editado'){ ?>
                                            <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                <strong>¡Actualizado!</strong> La venta fue editada correctamente.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php }elseif ($_GET['mensaje'] == 'eliminado'){ ?>
                                            <div class="alert alert-warning alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                <strong>¡Eliminado!</strong> La venta fue eliminada correctamente.
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
        
                                <section class="section-list">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Nombre y apellido</th>
                                                <th scope="col">Fecha de venta</th>
                                                <th scope="col">Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
        
                                            <!-- // -->
                                            <?php
                                                if($result->num_rows>0){
                                                    while($fila=$result->fetch_assoc()){
                                            ?>
                                                        <tr>
                                                            <td><?php echo $fila["id_venta"]; ?></td>
                                                            <td><?php echo $fila["nombreyapellido"]; ?></td>
                                                            <td><?php echo $fila["fecha_venta"]; ?></td>
                                                            <td>
                                                                <div class="d-sm-inline-block">
                                                                    <form action="detalle.php" method="post">
                                                                        <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila["id_venta"];?>">
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
                                                        <div class="text-center alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">No existen Ventas en la tabla</div>
                                                    </tr>
                                            <!-- // -->
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </section>
                    </div>
                    
    <div class="m-5 p-5"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
</body>
</html>

<!-- // -->
<?php
                //admin
                } elseif($_SESSION['rol']=="admin"){

                    $sql="SELECT venta.*, concat(usuario.nombre, ' ', usuario.apellido) AS nombreyapellido, beneficio.nombre FROM venta, usuario, beneficio, producto, detalle_venta WHERE (venta.id_usuario=usuario.id_usuario) AND (detalle_venta.id_venta=venta.id_venta) AND (detalle_venta.id_producto=producto.id_producto) AND (producto.id_beneficio=beneficio.id_beneficio) ORDER BY venta.fecha_venta DESC";
                    $stmt=$conex->prepare($sql);
                    if ($stmt->execute()){
                        $resultado=$stmt->get_result();
                    }
?>

                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Listado de ventas</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                        <link rel="stylesheet" href="../../sass/main.css">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <div class="text-center">
                            <div class="text-center my-5">
                                <h3 class="title-list">Listado de ventas</h3>
                            </div>
                        
                            <section class="container">
                                <div class="row">
        
                                    <div class="col-2 section-list">
                                        <a href="../inicio.php" class="btn btn-primary">Regresar al inicio</a>
                                    </div>
                                    <div class="col-8"></div>
                                    <div class="col-2 section-list">
                                        <a href="form.php" class="btn btn-primary">Agregar</a>
                                    </div>
    
                                    <!-- // -->
                                    <?php if (isset($_GET['mensaje'])){ ?>
                                        <div class="container mt-4">
                                            <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                    <strong>¡Éxito!</strong> La venta fue creada correctamente.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php }elseif ($_GET['mensaje'] == 'editado'){ ?>
                                                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                    <strong>¡Actualizado!</strong> La venta fue editada correctamente.
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
        
                                    <section class="section-list">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Vendedor</th>
                                                    <th scope="col">Beneficio</th>
                                                    <th scope="col">Entregado</th>
                                                    <th scope="col">Pagado</th>
                                                    <th scope="col">Fecha de venta</th>
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
                                                            <td><?php echo $fila["id_venta"]; ?></td>
                                                            <td><?php echo $fila["nombreyapellido"]; ?></td>
                                                            <td><?php echo $fila["nombre"]; ?></td>
                                                            <td><?php if($fila["entregado"]>0){ echo "Si"; } else{ echo "No"; };?></td>
                                                            <td><?php if($fila["pagado"]>0){ echo "Si"; } else{ echo "No"; };?></td>
                                                            <td><?php echo $fila["fecha_venta"]; ?></td>
                                                            <td>
                                                                <div class="d-sm-inline-block">
                                                                    <form action="detalle.php" method="post">
                                                                        <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila["id_venta"];?>">
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
                                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">No existen Ventas en la tabla</div>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </section>    
                                </div>
                            </section>
                        </div>

    <div class="m-5 p-5"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
<!-- // -->
<?php
                }

    //pendiente
    }else {
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>