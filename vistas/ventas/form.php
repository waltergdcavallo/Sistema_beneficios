<?php

    session_start();

    require_once "../../conexion.php";

    if(isset($_SESSION['rol']) && !empty($_SESSION['rol']) && $_SESSION['rol']!=="pendiente"){

        if(!empty($_POST['id_venta'])){
    
            $id_venta=$_POST['id_venta'];
            $sql="select * from venta, detalle_venta, producto where venta.id_venta=? group by venta.id_venta";
            $stmt=$conex->prepare($sql);
            $stmt->bind_param("i", $id_venta);
            if($stmt->execute()){
                $resultado=$stmt->get_result();
                $fila=$resultado->fetch_assoc();
            }
            $sql2="select nombre, id_producto from producto";
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
                <link rel="stylesheet" href="../../sass/main.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">  
            </head>
            <body>

            <?php include("../../complementario/encabezado.php") ?>

                <section class="container">

                    <div class="text-center my-5 text text-success">
                        <h3>Editar datos de la venta</h3>
                    </div>
                    
                    <div class="row">

                        <form action="../../publico/acciones/ventas/editar.php" method="post">
                            <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila["id_venta"];?>">
                            <input type="hidden" name="id_detalle_venta" id="id_detalle_venta" value="<?php echo $fila["id_detalle_venta"];?>">

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Código de venta</label>
                                    <input type="text" class="form-control" id="id_venta" name="id_venta" value="<?php echo $fila['id_venta'];?>" disabled>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Monto</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $fila['monto'];?>">
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Entregado</label>
                                    <select class="form-select" aria-label="Default select example" id="entregado" name="entregado">
                                        <option selected value="<?php $fila['entregado'];?>"><?php if(isset($fila['entregado']) && $fila['entregado']>0){echo "Si";}else {echo "No";}?></option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Pagado</label>
                                    <select class="form-select" aria-label="Default select example" id="pagado" name="pagado">
                                        <option selected value="<?php $fila['pagado'];?>"><?php if(isset($fila['pagado']) && $fila['pagado']>0){echo "Si";}else {echo "No";}?></option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                  <label for="exampleFormControlInput1" class="form-label">Fecha de la venta</label>
                                  <input type="text" class="form-control" id="fecha_venta" name="fecha_venta" value="<?php echo $fila['fecha_venta'];?>">
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Producto disponible</label>
                                    <select class="form-select" aria-label="Default select example" id="id_producto" name="id_producto">
                                        <option selected value="<?php echo $fila['id_producto'];?>"><?php echo $fila['nombre'];?></option>
                                            <?php
                                            if($resultado2->num_rows>0){
                                                while($fila2=$resultado2->fetch_assoc()){?>

                                                    <option value="<?php echo $fila2['id_producto'];?>"><?php echo $fila2['nombre'];?></option>

                                            <?php 
                                                }
                                            }?>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Cantidad de productos</label>
                                    <input type="text" class="form-control" id="cant_prod" name="cant_prod" value="<?php echo $fila['cant_prod'];?>">
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Fecha de entrega</label>
                                    <input type="text" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo $fila['fecha_entrega'];?>">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

<!-- // -->
<?php
            if (isset($_GET["mensaje"])){
                if ($_GET["mensaje"]!="ok"){
                    echo "<div class='text-center mt-4 mb-5'><div class='alert alert-danger' role='alert'><strong>".$_GET["mensaje"]."</strong></div></div>";
                } else{
                    echo "<div class='text-center mt-4 mb-5'><div class='alert alert-success' role='alert'><strong>Beneficio editado</strong></div></div>";
                }
            }
                
        } else{

            $sql="select id_producto, nombre from producto";
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
                <link rel="stylesheet" href="../../sass/main.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">  
            </head>
            <body>

            <?php include("../../complementario/encabezado.php") ?>

                <section class="container">

                    <div class="text-center my-5 text text-success">
                        <h3>Crear venta</h3>
                    </div>

                    
                    <form action="../../publico/acciones/ventas/crear.php" method="post">
                        <div class="row">

                            <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario'];?>">
                            
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Fecha de la venta</label>
                                <input type="date" class="form-control" id="fecha_venta" name="fecha_venta"required>
                            </div>
                            
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Producto disponible</label>
                                <select class="form-select" aria-label="Default select example" id="id_producto" name="id_producto" required>
                                    <option selected>Seleccione un producto</option>
                                        <?php
                                        if($resultado->num_rows>0){
                                            while($fila=$resultado->fetch_assoc()){?>

                                                <option value="<?php echo $fila['id_producto'];?>"><?php echo $fila['nombre'];?></option>

                                        <?php 
                                            }
                                        }?>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Cantidad de productos</label>
                                <input type="text" class="form-control" id="cant_prod" name="cant_prod" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Monto</label>
                                <input type="text" class="form-control" id="monto" name="monto" required>
                            </div>
                            
                            <div class="col-3 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Entregado</label>
                                <select class="form-select" aria-label="Default select example" id="entregado" name="entregado">
                                    <option selected value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            
                            <div class="mb-5 col-3">
                                <label for="exampleFormControlInput1" class="form-label">Pagado</label>
                                <select class="form-select" aria-label="Default select example" id="pagado" name="pagado">
                                    <option selected value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Fecha de entrega</label>
                                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                            </div>
    

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Crear venta</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </section>
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<?php
        }
    }else {
        header("Location: ../../complementario/error404.php");
    }
    exit;
?> 
</body>
</html>