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
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../sass/main.css">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container my-5">

                        <div class="div-form shadow">

                            <div class="text-center my-4 text">
                                <h3>Editar Beneficio</h3>
                            </div>
                    
                            <form action="../../publico/acciones/beneficios/editar.php" method="post" class="p-4 p-md-5 row g-4">
                    
                                <input type="hidden" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']; ?>">
                    
                                <div class="col-12 col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control input shadow" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>">
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" class="form-control input shadow" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>">
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                    <input type="date" class="form-control input shadow" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>">
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                    <input type="date" class="form-control input shadow" id="fecha_fin" name="fecha_fin" value="<?php echo $fila['fecha_fin']; ?>">
                                </div>
                    
                                <div class="col-12">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select input shadow" id="estado" name="estado">
                                        <option value="1" <?php echo ($fila['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
                                        <option value="0" <?php echo ($fila['estado'] == 0) ? 'selected' : ''; ?>>Terminado</option>
                                    </select>
                                </div>
                    
                                <div class="col-12 d-flex justify-content-between align-items-center mt-5 pt-2">
                                    <button type="submit" class="btn btn-confirm col-5 col-md-2">Editar</button>
                                    <a href="lista.php" class="btn btn-cancel col-5 col-md-2 text-center ms-auto">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </section>
                    <?php if (isset($_GET['mensaje'])){ ?>
                        <div class="container mt-4">
                            <?php if ($_GET['mensaje'] == 'error1'){ ?>
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
                        </div>
                    <?php } ?>
                    
    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>

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
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                        <link rel="stylesheet" href="../../sass/main.css">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <section class="container my-5">
                            <div class="div-form shadow">
                        
                                <div class="text-center my-4 text text-primary">
                                    <h3>Crear Beneficio</h3>
                                </div>
                        
                                <form action="../../publico/acciones/beneficios/crear.php" method="post" class="p-4 p-md-5 row g-4">
                        
                                    <div class="col-12 col-md-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control input shadow" id="nombre" name="nombre">
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <input type="text" class="form-control input shadow" id="descripcion" name="descripcion">
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control input shadow" id="fecha_inicio" name="fecha_inicio">
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="fecha_fin" class="form-label">Fecha de fin</label>
                                        <input type="date" class="form-control input shadow" id="fecha_fin" name="fecha_fin">
                                    </div>
                        
                                    <div class="col-12">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-select input shadow" id="estado" name="estado">
                                            <option selected disabled>Seleccione el estado</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Terminado</option>
                                        </select>
                                    </div>
                        
                                    <div class="col-12 d-flex justify-content-between align-items-center mt-5 pt-2">
                                        <button type="submit" class="btn btn-confirm col-5 col-md-2">Crear</button>
                                        <a href="lista.php" class="btn btn-cancel col-5 col-md-2 text-center ms-auto">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <?php if (isset($_GET['mensaje'])){ ?>
                            <div class="container mt-4">
                                <?php if ($_GET['mensaje'] == 'error'){ ?>
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
<!-- // -->
<?php
                }

    //vendedor y pendiente
    }else {
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>