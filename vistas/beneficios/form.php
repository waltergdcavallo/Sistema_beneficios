<?php

    //admin

    session_start();

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']=="admin"){

        require_once "../../conexion.php";

            if(!empty($_POST['id_beneficio'])){

                $id_beneficio=$_POST['id_beneficio'];

                $sql="select * from beneficio where id_beneficio=?";

                $stmt=$conex->prepare($sql);

                $stmt->bind_param("i", $id_beneficio);

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
                    <title>Editar beneficio</title>
                    <link rel="stylesheet" href="../../sass/main.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container">

                        <div class="text-center my-5 text text-primary">
                            <h3>Editar Beneficio</h3>
                        </div>


                        <div class="row">  
                            <form action="../../publico/acciones/beneficios/editar.php" method="post">

                                <input type="hidden" class="form-control" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']; ?>">

                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Fecha de inicio</label>
                                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Fecha de fin</label>
                                    <input type="text" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $fila['fecha_fin']; ?>">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>">
                                </div>

                                <div class="mb-5 col-12">
                                    <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                                    <option selected value="<?php echo $fila['estado']; ?>">Seleccione el estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Terminado</option>
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
                                    if ($_GET["mensaje"]!="ok"){
                                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                                    } else{
                                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Beneficio editado</strong></div></div>";
                                    }
                                }
                            ?>
                        </div>
                    </section>

<!-- // -->
<?php
                } else{
?>

                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Crear beneficio</title>
                        <link rel="stylesheet" href="../../sass/main.css">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <section class="container">

                            <div class="text-center my-5 text text-primary">
                                <h3>Crear Beneficio</h3>
                            </div>

                            <div class="row">

                                <form action="../../publico/acciones/beneficios/crear.php" method="post">

                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Fecha de fin</label>
                                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion">
                                    </div>

                                    <div class="mb-5 col-12">
                                        <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                                        <option selected>Seleccione el estado</option>
                                        <option value="1">Activo</option>
                                        <option value="0">Terminado</option>
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
                                        echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Beneficio agregado</strong></div></div>";
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