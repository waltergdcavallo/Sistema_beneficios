<?php

    session_start();

    require_once "../../conexion.php";

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']!=="pendiente"){

        if(!empty($_POST['id_venta'])){
    
            $id_venta=$_POST['id_venta'];
            $sql="SELECT *, (producto.nombre) AS nombreprod, (beneficio.nombre) AS nombrebene FROM venta, detalle_venta, producto, beneficio WHERE (detalle_venta.id_producto=producto.id_producto) AND (producto.id_beneficio=beneficio.id_beneficio) AND venta.id_venta=? GROUP BY venta.id_venta";
            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_venta);
            if($stmt->execute()){
                $resultado=$stmt->get_result();
                $fila=$resultado->fetch_assoc();
            }
            $sql2="SELECT producto.id_producto, (producto.nombre) AS nombreprod, (beneficio.nombre) AS nombrebene FROM producto, beneficio WHERE (producto.id_beneficio=beneficio.id_beneficio) AND beneficio.estado=1";
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
                <title>Editar venta</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">  
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

            <?php include("../../complementario/encabezado.php") ?>

                <section class="container my-5">

                    <div class="div-form shadow">
                        
                        <div class="text-center my-5">
                            <h3>Editar datos de la venta</h3>
                        </div>

                        <form action="../../publico/acciones/ventas/editar.php" method="post" class="p-5 row">
                            <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila["id_venta"];?>">
                            <input type="hidden" name="id_detalle_venta" id="id_detalle_venta" value="<?php echo $fila["id_detalle_venta"];?>" required>

                                <div class="mb-4 col-3">
                                    <label for="exampleFormControlInput1" class="form-label">Monto</label>
                                    <input type="text" class="form-control input shadow" id="monto" name="monto" value="<?php echo $fila['monto'];?>" required>
                                </div>

                                <div class="mb-4 col-3">
                                    <label for="exampleFormControlInput1" class="form-label">Entregado</label>
                                    <select class="form-select input shadow" aria-label="Default select example" id="entregado" name="entregado">
                                        <option selected value="<?php $fila['entregado'];?>"><?php if(isset($fila['entregado']) && $fila['entregado']>0){echo "Si";}else {echo "No";}?></option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>

                                <div class="mb-4 col-3">
                                    <label for="exampleFormControlInput1" class="form-label">Pagado</label>
                                    <select class="form-select input shadow" aria-label="Default select example" id="pagado" name="pagado">
                                        <option selected value="<?php $fila['pagado'];?>"><?php if(isset($fila['pagado']) && $fila['pagado']>0){echo "Si";}else {echo "No";}?></option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>

                                
                                <div class="mb-4 col-5">
                                    <label for="exampleFormControlInput1" class="form-label">Producto disponible</label>
                                    <select class="form-select input shadow" aria-label="Default select example" id="id_producto" name="id_producto" required>
                                        <option selected value="<?php echo $fila['id_producto'];?>"><?php echo $fila['nombreprod'];?> Beneficio: <?php echo $fila["nombrebene"];?></option>
                                        <?php
                                            if($resultado2->num_rows>0){
                                                while($fila2=$resultado2->fetch_assoc()){?>

                                                <option value="<?php echo $fila2['id_producto'];?>"><?php echo $fila2['nombreprod'];?> Beneficio: <?php echo $fila2["nombrebene"];?></option>
                                                
                                                <?php 
                                                }
                                                }?>
                                    </select>
                                </div>
                                
                                <div class="mb-4 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Cantidad de productos</label>
                                    <input type="text" class="form-control" id="cant_prod" name="cant_prod" value="<?php echo $fila['cant_prod'];?>" required>
                                </div>
                                
                                <div class="mb-4 col-6">
                                  <label for="exampleFormControlInput1" class="form-label">Fecha de la venta</label>
                                  <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" value="<?php echo $fila['fecha_venta'];?>" required>
                                </div>

                                <div class="mb-4 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Fecha de entrega</label>
                                    <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo $fila['fecha_entrega'];?>" required>
                                </div>

                                    <button type="submit" class="btn btn-confirm col-2">Actualizar</button>
                                    <a href="lista.php" class="btn btn-cancel col-2 ms-auto">Cancelar</a>
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

            $sql="SELECT producto.id_producto, (producto.nombre) AS nombreprod1, (beneficio.nombre) AS nombrebene1 FROM producto, beneficio WHERE (producto.id_beneficio=beneficio.id_beneficio)";
            $stmt=$conex->prepare($sql);
            if($stmt->execute()){
                $resultado=$stmt->get_result();
            }
?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Crear venta</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">  
                <link rel="stylesheet" href="../../sass/main.css">
            </head>
            <body>

            <?php include("../../complementario/encabezado.php") ?>

            <section class="container my-5">
                <div class="div-form shadow p-4 p-md-5">
            
                    <div class="text-center mb-4 text">
                        <h3>Crear venta</h3>
                    </div>
            
                    <form action="../../publico/acciones/ventas/crear.php" method="post" class="row g-3">
            
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
            
                        <div class="col-12 col-md-6">
                            <label for="fecha_venta" class="form-label">Fecha de la venta</label>
                            <input type="date" class="form-control shadow-sm" id="fecha_venta" name="fecha_venta" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
            
                        <div class="col-12 col-md-6">
                            <label for="id_producto" class="form-label">Producto disponible</label>
                            <!-- // -->
                            <?php
                            if(isset($_GET["id_beneficio"])){
                                $id_beneficio=$_GET["id_beneficio"];
                                $sql2="SELECT producto.id_producto, (producto.nombre) AS nombreprod2, (beneficio.nombre) AS nombrebene2 FROM producto, beneficio WHERE (producto.id_beneficio=beneficio.id_beneficio) AND beneficio.id_beneficio=? AND beneficio.estado=1";
                                $stmt2=$conex->prepare($sql2);
                                $stmt2->bind_param("i", $id_beneficio);
                                if($stmt2->execute()){
                                    $resultado2=$stmt2->get_result();
                                    $fila2=$resultado2->fetch_assoc();
                                }
                            }
                            ?>
                            <select class="form-select shadow-sm" id="id_producto" name="id_producto" required>
                                
                                <?php if($fila2["id_producto"]>0 && isset($_GET["id_beneficio"])){?>
                                    <option value="<?php $fila["id_producto"]?>" selected><?php echo $fila2["nombreprod2"]?> Beneficio: <?php echo $fila2["nombrebene2"];?></option>
                                <?php }else{?>
                                        <option value="" disabled selected>Seleccione un producto</option>
                                <?php }
                                    if ($resultado->num_rows > 0){ ?>
                                    <?php while ($fila = $resultado->fetch_assoc()){ ?>
                                        <option value="<?php echo $fila['id_producto'];?>">
                                            <?php echo $fila['nombreprod1'];?> Beneficio: <?php echo $fila["nombrebene1"];?>
                                        </option>
                                    <?php }?>
                                <?php }?>
                            </select>
                        </div>
            
                        <div class="col-12 col-md-6">
                            <label for="cant_prod" class="form-label">Cantidad de productos</label>
                            <input type="number" class="form-control shadow-sm" id="cant_prod" name="cant_prod" min="1" placeholder="Ej: 2" required>
                        </div>
            
                        <div class="col-12 col-md-6">
                            <label for="monto" class="form-label">Monto ($)</label>
                            <input type="number" step="0.01" min="0" class="form-control shadow-sm" id="monto" name="monto" placeholder="Ej: 1500.00" required>
                        </div>
            
                        <div class="col-12 col-md-3">
                            <label for="entregado" class="form-label">Entregado</label>
                            <select class="form-select shadow-sm" id="entregado" name="entregado" required>
                                <option value="0" selected>No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
            
                        <div class="col-12 col-md-3">
                            <label for="pagado" class="form-label">Pagado</label>
                            <select class="form-select shadow-sm" id="pagado" name="pagado" required>
                                <option value="0" selected>No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
            
                        <div class="col-12 col-md-6">
                            <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                            <input type="date" class="form-control shadow-sm" id="fecha_entrega" name="fecha_entrega" required>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center mt-4 pt-2">
                            <button type="submit" class="btn btn-confirm col-5 col-md-2">Crear venta</button>
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
<?php
        }
    }else {
        header("Location: ../../complementario/error404.php");
        }
    exit;
?> 
