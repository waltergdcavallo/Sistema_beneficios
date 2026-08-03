<?php

    //admin

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']=="admin"){


        require_once "../../conexion.php";

        $sql="select *, concat(nombre, ' ', apellido) as nombreyapellido from usuario order by nombre asc";

        $stmt=$conex->prepare($sql);

        if ($stmt->execute()){
            $result=$stmt->get_result();
        }

?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Listado de Usuarios</title>
            <link rel="stylesheet" href="../../sass/main.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        </head>
        <body>

            <?php include("../../complementario/encabezado.php") ?>

            <div class="text-center">
                <div class="text-center my-5">
                    <h3>Listado de Usuarios</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-10"></div>

                            <div class="col-2">
                            <a href="form.php" class="btn btn-primary">Agregar</a>
                            <div>

                        </div>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre y apellido</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- // -->
                        <?php
                            if($result->num_rows>0){
                                while($fila=$result->fetch_assoc()){

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
                                <div class="alert alert-danger text-center">No existen Usuarios en la tabla</div>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- // -->
                <?php
                if (isset($_GET["mensaje"])){
                    if ($_GET["mensaje"]!="ok"){
                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                    } else{
                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Usuario editado</strong></div></div>";
                    }
                }
                ?>
            </div>

<!-- // -->
<?php

    //vendedor y pendiente
    } else{
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>