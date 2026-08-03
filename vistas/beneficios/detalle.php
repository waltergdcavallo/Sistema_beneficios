<?php 

    //admin

    session_start();

    if (isset($_SESSION['rol']) && !empty($_SESSION['rol'])) {
        if ($_SESSION['rol']=="admin" || $_SESSION['rol']=="vendedor") {
            
            require_once "../../conexion.php";

            $id_beneficio=$_POST['id_beneficio'];

            $sql="select *, beneficio.nombre as nombrebene from beneficio, producto where (producto.id_beneficio=beneficio.id_beneficio) and beneficio.id_beneficio=?";

            $stmt=$conex->prepare($sql);

            $stmt->bind_param("i", $id_beneficio);

            $stmt->execute();

            $resultado=$stmt->get_result();

            $fila=$resultado->fetch_assoc();

            if($fila['estado']===1 && $_SESSION['rol']=="vendedor" || $_SESSION['rol']=="admin"){
?>

                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>
                        Beneficio <?php $fila["nombrebene"]?>
                    </title>
                    <link rel="stylesheet" href="../../sass/main.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container">

                        <div class="text-center my-5 text text-primary">
                            <h3>Beneficio <?php echo $fila["nombrebene"]?></h3>
                        </div>

                        <div class="row">

                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput1" class="form-label">Fecha de inicio</label>
                                <input class="form-control" type="text" value="<?php echo $fila['fecha_inicio'];?>" aria-label="Disabled input example" disabled>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput1" class="form-label">fecha fin del beneficio</label>
                                <input class="form-control" type="text" value="<?php echo $fila['fecha_fin'];?>" aria-label="Disabled input example" disabled>
                            </div>


                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                <input class="form-control" type="text" value="<?php echo $fila['descripcion'];?>" aria-label="Disabled input example" disabled>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput1" class="form-label">Estado</label>
                                <input class="form-control" type="text" value="<?php if($fila['estado']>0)
                                    { echo "Activo";
                                    } else { echo "Terminado";
                                    } ?>" aria-label="Disabled input example" disabled>
                            </div>

                            <!-- // -->
                            <?php if($_SESSION['rol']=="admin"){ ?>

                            <div class="tect-center">
                                <div class="d-sm-inline-block">
                                    <form action="form.php" method="post">
                                        <input type="hidden" name="id_beneficio" id="id_beneficio" value="<?php echo $fila["id_beneficio"];?>">
                                        <button class="btn btn-primary p-1" type="submit">Editar</button>
                                    </form>
                                </div>
    
                                <div class="d-sm-inline-block">
                                    <form action="../../publico/acciones/beneficios/eliminar.php" method="post">
                                        <input type="hidden"name="id_beneficio" id="id_beneficio" value="<?php echo $fila["id_beneficio"];?>">
                                        <button class="btn btn-danger p-1" type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            <!-- // -->
                            <?php 
                                   } 
                            ?>
                        </div>
                    </section>

<!-- // -->
<?php 
            } else {
                header("Location: ../../complementario/mensaje.php");
            }
            exit;

        } else{
            header("Location: ../../complementario/error404.php");
        }
        exit;
    }
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>