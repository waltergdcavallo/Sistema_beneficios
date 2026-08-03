<?php

    // admin

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']=="admin"){

        require_once "../../conexion.php";

            if(!empty($_POST['id_producto'])){

                $id_producto=$_POST['id_producto'];
                $sql="select producto.*, (beneficio.nombre) as nombrebeneficio from producto, beneficio where (beneficio.id_beneficio=producto.id_beneficio) and id_producto=?";
                $stmt=$conex->prepare($sql);
                $stmt->bind_param("i", $id_producto);
                if ($stmt->execute()){
                    $resultado=$stmt->get_result();
                    $fila=$resultado->fetch_assoc();
                }

                $sql2="select nombre, id_beneficio from beneficio where estado=1";
                $stmt2=$conex->prepare($sql2);
                if($stmt2->execute()){
                    $resultado2=$stmt2->get_result();
                }
?>

                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Editar producto</title>
                    <link rel="stylesheet" href="../../sass/main.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container">

                        <div class="text-center my-5 text text-primary">
                            <h3>Editar producto</h3>
                        </div>

                        <div class="row">  
                            <form action="../../publico/acciones/productos/editar.php" method="post">

                                <input type="hidden" class="form-control" id="id_producto" name="id_producto" value="<?php echo $fila['id_producto']; ?>">

                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Precio</label>
                                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $fila['precio']; ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stock inicial</label>
                                    <input type="text" class="form-control" id="stock_inicial" name="stock_inicial" value="<?php echo $fila['stock_inicial']; ?>">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stock actual</label>
                                    <input type="text" class="form-control" id="stock_actual" name="stock_actual" value="<?php echo $fila['stock_actual']; ?>">
                                </div>

                                <div class="mb-5 col-12">
                                    <select class="form-select" aria-label="Default select example" id="id_beneficio" name="id_beneficio">
                                    <option selected><?php echo $fila['nombre'];?></option>

                                    <!-- // -->
                                    <?php

                                        if($resultado2->num_rows>0){
                                            while($fila2=$resultado2->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $fila2['id_beneficio'];?>"><?php echo $fila2['nombre'];?></option>
                                    <?php

                                            }
                                        } else{
                                            ?>
                                            <option>No existen beneficios activos para vincular</option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Editar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                </div>
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
                } else{

                    $sql="select id_beneficio, nombre from beneficio where estado=1";

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
                        <title>Crear producto</title>
                        <link rel="stylesheet" href="../../sass/main.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <section class="container">

                            <div class="text-center my-5 text text-primary">
                                <h3>Crear producto</h3>
                            </div>

                            <div class="row">

                                <form action="../../publico/acciones/productos/crear.php" method="post">

                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="precio" name="precio" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Stock inicial</label>
                                        <input type="number" class="form-control" id="stock_inicial" name="stock_inicial" required>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Stock actual</label>
                                        <input type="number" class="form-control" id="stock_actual" name="stock_actual" required>
                                    </div>

                                    <div class="mb-5 col-12">
                                        <option selected>Seleccione el beneficio</option>
                                        <select class="form-select" aria-label="Default select example" id="id_beneficio" name="id_beneficio" required>

                                        <!-- // -->
                                        <?php
                                            if($result->num_rows>0){
                                                while($fila=$result->fetch_assoc()){

                                        ?>

                                        <option value="<?php echo $fila['id_beneficio'];?>"><?php echo $fila['nombre'];?></option>

                                        <?php
                                                }
                                            } else{
                                                ?>
                                                <option value="">No existen beneficios activos</option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="text-center">

                                        <button type="submit" class="btn btn-success">Crear</button>

                                        <button type="reset" class="btn btn-danger">Cancelar</button>
                                    </div>
                                </form>
                                <!-- // -->
                                <?php
                                if (isset($_GET["mensaje"])){
                                    if ($_GET["mensaje"]!="ok"){
                                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                                    } else{
                                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Producto creado</strong></div></div>";
                                    }
                                }
                                ?>
                            </div>
                        </section>
                        
<!-- // -->
<?php
                }

    //vendedor y pendiente
}else {
    header("Location: ../../complementario/error404.php");
}
exit;
?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>
