<?php

    session_start();

    if (isset($_SESSION['rol']) && !empty($_SESSION['rol'])) {
        if ($_SESSION['rol']=="admin" || $_SESSION['rol']=="vendedor" || $_SESSION['rol']=='pendiente') {

            require_once "../../conexion.php";
        
            $id_producto=$_POST["id_producto"];
        
            $sql="select producto.*, (beneficio.nombre) as nombrebeneficio, beneficio.id_beneficio from producto, beneficio where (producto.id_beneficio=beneficio.id_beneficio) and id_producto=?";
            
            $stmt=$conex->prepare($sql);
            
            $stmt->bind_param("i", $id_producto);
            
            $stmt->execute();
            
            $resultado=$stmt->get_result();
            
            $fila=$resultado->fetch_assoc();
?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>
                    Detalle del producto
                </title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>
            
                <?php include("../../complementario/encabezado.php") ?>
                 
                <section class="container section-detail my-5">
                    
                    <div class="text-center mb-4">
                          <h3 class="detail-title">Producto: <?php echo $fila['nombre']; ?></h3>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" value="<?php echo $fila['nombre']; ?>" disabled>
                        </div>
                    
                        <div class="col-12 col-md-6">
                            <label for="precio" class="form-label">Precio unitario</label>
                            <input type="text" class="form-control" id="precio" value="<?php echo $fila['precio']; ?>" disabled>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label for="stock_inicial" class="form-label">Stock inicial</label>
                            <input type="text" class="form-control" id="stock_inicial" value="<?php echo $fila['stock_inicial']; ?>" disabled>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label for="stock_actual" class="form-label">Stock actual</label>
                            <input type="text" class="form-control" id="stock_actual" value="<?php echo $fila['stock_actual']; ?>" disabled>
                        </div>
                        
                        <div class="col-12">
                            <label for="nombrebeneficio" class="form-label">Beneficio asociado</label>
                            <form action="../beneficios/detalle.php" method="post" class="d-flex gap-2">
                                <input type="text" class="form-control" id="nombrebeneficio" value="<?php echo $fila['nombrebeneficio']; ?>" disabled>
                                <input type="hidden" name="id_beneficio" value="<?php echo $fila['id_beneficio']; ?>">
                                <button class="btn btn-view" type="submit">Ver</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="detail-actions d-flex justify-content-between align-items-center mt-5 pt-4">
                          <form action="form.php" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                            <button class="btn btn-edit" type="submit">Editar</button>
                          </form>
                    
                          <form action="../../publico/acciones/beneficios/eliminar.php" method="post">
                            <input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>">
                            <button class="btn btn-del" type="submit" onclick="return confirm('¿Eliminar producto?');">Eliminar</button>
                          </form>
                    </div>
                
                </section>
                
                <section class="container">
                    <div class="row">
                        <div class="col-2 section-list">
                            <a href="../inicio.php" class="btn btn-primary">Regresar al inicio</a>
                        </div>
                    </div>
                </section>
            
                <div class="m-4 p-4"></div>
                <!-- // -->
                <?php include("../../complementario/pie.php") ?>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
            </body>
            </html>

<!-- // -->
<?php

        } else{
            header("Location: ../../complementario/error404.php");
        }
        exit;
    } else{
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>