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
                    <title>Lista de ventas</title>
                    <link rel="stylesheet" href="../../sass/main.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container">

                        <div class="text-center my-5 text text-primary">
                            <h3><?php if(isset($fila['nombreyapellido'])){echo "Ventas de: ".$fila['nombreyapellido'];}else{ echo "Este usuario no tiene ventas";}?></h3>
                        </div>

                        <div class="row">
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
                                                <div class="alert alert-danger text-center">No existen Venta en la tabla</div>
                                            </tr>
                                    <!-- // -->
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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
                        ?>
                    </section>
<!-- // -->
<?php
                //admin
                } elseif($_SESSION['rol']=="admin"){

                    $sql="select venta.*, concat(usuario.nombre, ' ', usuario.apellido) as nombreyapellido from venta, usuario where (venta.id_usuario=usuario.id_usuario) order by venta.id_venta desc";
                    $stmt=$conex->prepare($sql);
                    if ($stmt->execute()){
                        $result=$stmt->get_result();
                    }
?>

                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Lista de ventas</title>
                        <link rel="stylesheet" href="../../sass/main.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <section class="container">

                            <div class="text-center my-5 text text-primary">
                                <h3>Lista de ventas</h3>
                            </div>

                            <div class="row">

                                <div class="col-10"></div>
                                    <div class="col-2">
                                        <a href="form.php" class="btn btn-primary">Agregar</a>
                                    <div>
                                </div>
                            </div>

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
                                            <div class="alert alert-danger text-center">No existen Venta en la tabla</div>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table> 
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
                            ?>
                        </section>
<!-- // -->
<?php
                }

    //pendiente
    }else {
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>

   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>