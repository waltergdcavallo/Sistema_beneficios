<?php 

    //admin

    session_start();

    if (isset($_SESSION['rol']) && !empty($_SESSION['rol'])) {
        if ($_SESSION['rol']=="admin" || $_SESSION['rol']=="vendedor") {
            
            require_once "../../conexion.php";

            $id_beneficio=$_POST['id_beneficio'];

            $sql="select beneficio.*, beneficio.nombre as nombrebene from beneficio where beneficio.id_beneficio=?";

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
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                    <link rel="stylesheet" href="../../sass/main.css">
                </head>
                <body>

                    <?php include("../../complementario/encabezado.php") ?>

                    <section class="container my-5 section-detail">

                        <div class="text-center mb-4">
                            <h3 class="detail-title">Beneficio <?php echo $fila["nombrebene"]; ?></h3>
                        </div>
                      
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                <input type="text" class="form-control" id="fecha_inicio" value="<?php echo $fila['fecha_inicio'];?>" disabled>
                            </div>
                        
                            <div class="col-12 col-md-6">
                                <label for="fecha_fin" class="form-label">Fecha fin del beneficio</label>
                                <input type="text" class="form-control" id="fecha_fin" value="<?php echo $fila['fecha_fin'];?>" disabled>
                            </div>
                    
                            <div class="col-12 col-md-6">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" value="<?php echo $fila['descripcion'];?>" disabled>
                            </div>
                    
                            <div class="col-12 col-md-6">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" value="<?php echo ($fila['estado'] > 0) ? 'Activo' : 'Terminado'; ?>" disabled>
                            </div>
                         
                            <!-- // -->
                            <?php
                            $sql="select producto.nombre as nombreprod from beneficio, producto where (producto.id_beneficio=beneficio.id_beneficio) and beneficio.id_beneficio=?";
                            $stmt2=$conex->prepare($sql);
                            $stmt2->bind_param("i", $id_beneficio);
                            $stmt2->execute();
                            $resultado2=$stmt2->get_result();
                            $fila2=$resultado2->fetch_assoc();
                            ?>

                            <div class="col-12 col-md-6">
                                <label for="estado" class="form-label">Producto relacionado</label>
                                <input type="text" class="form-control" id="nombre" value="<?php if(!empty($fila2['nombreprod'])) {echo $fila2['nombreprod'];}else{echo 'Sin producto asignado';}  ?>" disabled>
                            </div>
                        </div>
                      
                          <?php if($_SESSION['rol'] == "admin"): ?>
                              <div class="detail-actions d-flex justify-content-between align-items-center mt-5 pt-3">
                                  <form action="../historial/lista.php" method="post">
                                      <input type="hidden" name="id_beneficio" id="id_beneficio" value="<?php echo $fila['id_beneficio'];?>">
                                      <button class="btn btn-view" type="submit">Ver registrados</button>
                                  </form>

                                  <form action="form.php" method="post">
                                      <input type="hidden" name="id_beneficio" id="id_beneficio" value="<?php echo $fila['id_beneficio'];?>">
                                      <button class="btn btn-edit" type="submit">Editar</button>
                                  </form>
                        
                                  <form action="../../publico/acciones/beneficios/eliminar.php" method="post">
                                      <input type="hidden" name="id_beneficio" id="id_beneficio" value="<?php echo $fila['id_beneficio'];?>">
                                      <button class="btn btn-del" type="submit" onclick="return confirm('¿Eliminar beneficio?');">Eliminar</button>
                                  </form>
                              </div>
                          <?php endif; ?>
                      
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
            } else {
                header("Location: ../../complementario/mensaje.php");
            }
            exit;

        } else{
            header("Location: ../../complementario/error404.php");
        }
        exit;
    } else{
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>