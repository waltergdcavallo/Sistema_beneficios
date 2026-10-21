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
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../sass/main.css">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container my-5">
                        <div class="div-form shadow p-4 p-md-5">
                    
                            <div class="text-center mb-4 text">
                                <h3>Editar producto</h3>
                            </div>
                    
                            <form action="../../publico/acciones/productos/editar.php" method="post" class="row g-4">
                    
                                <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                    
                                <div class="col-12 col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control input shadow" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" step="0.01" min="0" class="form-control input shadow" id="precio" name="precio" value="<?php echo $fila['precio']; ?>" required>
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="stock_inicial" class="form-label">Stock inicial</label>
                                    <input type="number" min="0" class="form-control input shadow" id="stock_inicial" name="stock_inicial" value="<?php echo $fila['stock_inicial']; ?>" required>
                                </div>
                    
                                <div class="col-12 col-md-6">
                                    <label for="stock_actual" class="form-label">Stock actual</label>
                                    <input type="number" min="0" class="form-control input shadow" id="stock_actual" name="stock_actual" value="<?php echo $fila['stock_actual']; ?>" required>
                                </div>
                    
                                <div class="col-12">
                                    <label for="id_beneficio" class="form-label">Beneficio asociado</label>
                                    <select class="form-select input shadow" id="id_beneficio" name="id_beneficio" required>
                                        <?php if ($resultado2 && $resultado2->num_rows > 0): ?>
                                            <option value="">-- Seleccionar Beneficio --</option>
                                            <?php while ($fila2 = $resultado2->fetch_assoc()): ?>
                                                <option value="<?php echo $fila2['id_beneficio']; ?>" <?php echo ($fila2['id_beneficio'] == $fila['id_beneficio']) ? 'selected' : ''; ?>>
                                                    <?php echo $fila2['nombre']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <option value="">No existen beneficios activos para vincular</option>
                                        <?php endif; ?>
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
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                        <link rel="stylesheet" href="../../sass/main.css">
                    </head>
                    <body>

                        <?php include("../../complementario/encabezado.php") ?>

                        <section class="container my-5">
                            <div class="div-form shadow p-4 p-md-5">
                        
                                <div class="text-center mb-4 text text-primary">
                                    <h3>Crear producto</h3>
                                </div>
                        
                                <form action="../../publico/acciones/productos/crear.php" method="post" class="row g-3">
                        
                                    <div class="col-12 col-md-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control input shadow-sm" id="nombre" name="nombre" placeholder="Nombre del producto" required>
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="precio" class="form-label">Precio ($)</label>
                                        <input type="number" step="0.01" min="0" class="form-control input shadow-sm" id="precio" name="precio" placeholder="Ej: 2500.00" required>
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="stock_inicial" class="form-label">Stock inicial</label>
                                        <input type="number" min="0" class="form-control input shadow-sm" id="stock_inicial" name="stock_inicial" placeholder="Ej: 100" required>
                                    </div>
                        
                                    <div class="col-12 col-md-6">
                                        <label for="stock_actual" class="form-label">Stock actual</label>
                                        <input type="number" min="0" class="form-control input shadow-sm" id="stock_actual" name="stock_actual" placeholder="Ej: 100" required>
                                    </div>
                        
                                    <div class="col-12">
                                        <label for="id_beneficio" class="form-label">Beneficio asociado</label>
                                        <select class="form-select input shadow-sm" id="id_beneficio" name="id_beneficio" required>
                                            <option value="" disabled selected>Seleccione el beneficio</option>
                                            <?php if (isset($result) && $result->num_rows > 0): ?>
                                                <?php while ($fila = $result->fetch_assoc()): ?>
                                                    <option value="<?php echo $fila['id_beneficio']; ?>">
                                                        <?php echo $fila['nombre']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <option value="" disabled>No existen beneficios activos</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                        
                                    <div class="col-12 d-flex justify-content-between align-items-center mt-4 pt-2">
                                        <button type="submit" class="btn btn-confirm col-5 col-md-2">Crear</button>
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
                }

    //vendedor y pendiente
}else {
    header("Location: ../../complementario/error404.php");
}
exit;
?>
