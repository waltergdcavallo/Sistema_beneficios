<?php

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']!="pendiente"){

        require_once "../../conexion.php";

        if(!empty($_POST['id_usuario'])){

            $id_usuario=$_POST['id_usuario'];
            $sql="select *, (usuario.nombre) as nombreusuario, (beneficio.nombre) as nombrebene from beneficio, usuario, historial where (historial.id_usuario=usuario.id_usuario) and (historial.id_beneficio=beneficio.id_beneficio) and historial.id_usuario=? group by historial.id_usuario";
            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_usuario);
            if ($stmt->execute()){
            $resultado=$stmt->get_result();
            }
?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Historial</title>
            <link rel="stylesheet" href="../../sass/main.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        </head>
        <body>

            <?php include("../../complementario/encabezado.php") ?>
            
            <div class="text-center">
                <div class="text-center my-5">
                    <h3>Historial del usuario</h3>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del usuario</th>
                            <th scope="col">Dni</th>
                            <th scope="col">Nombre del beneficio</th>
                            <th scope="col">Estado del beneficio</th>
                            <th scope="col">Fecha de la inscripcion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- // -->
                        <?php
                            if($resultado->num_rows>0){
                                while($fila=$resultado->fetch_assoc()){

                        ?>
                                    <tr>
                                        <td><?php echo $fila["id_historial"]; ?></td>
                                        <td><?php echo $fila["nombreusuario"]; ?></td>
                                        <td><?php echo $fila["dni"]; ?></td>
                                        <td><?php echo $fila["nombrebene"]; ?></td>
                                        <td><?php if($fila["estado"]>0){ echo "Activo"; } else{ echo "Terminado"; };?></td>
                                        <td><?php echo $fila["fecha_inscripto"]; ?></td>
                                        <td>
                                            <div class="d-sm-inline-block">
                                                <form action="../usuarios/detalle.php" method="post">
                                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $fila["id_usuario"];?>">
                                                    <button class="btn btn-success p-1" type="submit">Ver usuario</button>
                                                </form>
                                            </div>
                                            <div class="d-sm-inline-block">
                                                <form action="../beneficios/detalle.php" method="post">
                                                    <input type="hidden"name="id_beneficio" id="id_beneficio" value="<?php echo $fila["id_beneficio"];?>">
                                                    <button class="btn btn-primary p-1" type="submit">Ver beneficio</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                        <!-- // -->
                        <?php
                            }
                        }else {
                        ?>
                            <tr>
                                <td scope="5"></td>
                                <div class="alert alert-danger text-center">No existe historial de este usuario</div>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

<!-- // -->
<?php

        } elseif(!empty($_POST['id_beneficio']) && $_SESSION=="admin"){

            $id_beneficio=$_POST['id_beneficio'];

            $sql="select *, (usuario.nombre) as nombreusuario, (beneficio.nombre) as nombrebeneficio from beneficio, usuario, historial where historial.id_beneficio=? order by historial.id_beneficio desc";

            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_beneficio);

            if ($stmt->execute()){
            $result=$stmt->get_result();
            }
?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Historial</title>
                <link rel="stylesheet" href="../../sass/main.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            </head>
            <body>

                <?php include("../../complementario/encabezado.php") ?>

                <div class="text-center">
                    <div class="text-center my-5">
                        <h3>Historial del beneficio</h3>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre del beneficio</th>
                                <th scope="col">Estado del beneficio</th>
                                <th scope="col">Nombre del usuario</th>
                                <th scope="col">Dni</th>
                                <th scope="col">Fecha de la inscripcion</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- // -->
                            <?php
                                if($result->num_rows>0){
                                    while($fila=$result->fetch_assoc()){

                            ?>
                                        <tr>
                                            <td><?php echo $fila["id_historial"]; ?></td>
                                            <td><?php echo $fila["nombrebeneficio"]; ?></td>
                                            <td><?php if($fila["estado"]>0){ echo "Activo"; } else{ echo "Terminado"; };?></td>
                                            <td><?php echo $fila["nombreusuario"]; ?></td>
                                            <td><?php echo $fila["dni"]; ?></td>
                                            <td><?php echo $fila["fecha_inscripto"]; ?></td>
                                            <td>
                                                <div class="d-sm-inline-block">
                                                    <form action="../beneficios/detalle.php" method="post">
                                                        <input type="hidden"name="id_beneficio" id="id_beneficio" value="<?php echo $fila["id_beneficio"];?>">
                                                        <button class="btn-sm btn-outline-danger p-1" type="submit">Ver beneficio</button>
                                                    </form>
                                                </div>
                                                <div class="d-sm-inline-block">
                                                    <form action="../usuarios/detalle.php" method="post">
                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $fila["id_usuario"];?>">
                                                        <button class="btn-sm btn-outline-success p-1" type="submit">Ver usuario</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                            <!-- // -->
                            <?php
                                }
                            }else {
                            ?>
                                <tr>
                                    <td scope="5"></td>
                                    <div class="alert alert-danger text-center">No existe historial de este beneficio</div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

<!-- // -->
<?php

        }elseif($_SESSION['rol']=="admin"){

            $sql="select *, (usuario.nombre) as nombreusuario, (beneficio.nombre) as nombrebeneficio from beneficio, usuario, historial where (historial.id_beneficio=beneficio.id_beneficio) and (historial.id_usuario=usuario.id_usuario) order by id_historial desc";
    
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
                <title>Historial</title>
                <link rel="stylesheet" href="../../sass/main.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            </head>
            <body>

                <?php include("../../complementario/encabezado.php") ?>

                <div class="text-center">
                    <div class="text-center my-5">
                        <h3>Historial general</h3>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre del usuario</th>
                                <th scope="col">Dni</th>
                                <th scope="col">Nombre del beneficio</th>
                                <th scope="col">Estado del beneficio</th>
                                <th scope="col">Fecha de la inscripcion</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- // -->
                            <?php
                                if($result->num_rows>0){
                                    while($fila=$result->fetch_assoc()){

                            ?>
                                        <tr>
                                            <td><?php echo $fila["id_historial"]; ?></td>
                                            <td><?php echo $fila["nombreusuario"]; ?></td>
                                            <td><?php echo $fila["dni"]; ?></td>
                                            <td><?php echo $fila["nombrebeneficio"]; ?></td>
                                            <td><?php if($fila["estado"]>0){ echo "Activo"; } else{ echo "Terminado"; };?></td>
                                            <td><?php echo $fila["fecha_inscripto"]; ?></td>
                                        </tr>

                            <!-- // -->
                            <?php
                                }
                            }else {
                            ?>
                                <tr>
                                    <td scope="5"></td>
                                    <div class="alert alert-danger text-center">No existe historial</div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

<!-- //     -->
<?php   
            }else{
                header("Location: ../../complementario/error404.php");
            }
            exit;

        } else{
            header("Location: ../../complementario/error404.php");
        }
        exit;
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>