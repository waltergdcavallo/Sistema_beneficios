<?php

    session_start();

    require_once "../../conexion.php";

    if($_POST['id_venta']){

        $id_venta=$_POST["id_venta"];

        $sql="select *, (venta.monto-producto.precio*detalle_venta.cant_prod) as ganancia, producto.nombre as nombre_producto, (producto.precio*detalle_venta.cant_prod) as precio_bruto, concat(usuario.nombre,', ', usuario.apellido) as nombreyapellido from detalle_venta, venta, producto, usuario where (venta.id_usuario=usuario.id_usuario) and venta.id_venta=? group by venta.id_venta";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("i", $id_venta);

        if($stmt->execute()){
            $resultado=$stmt->get_result();
            $fila=$resultado->fetch_assoc();
        }
?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                Detalle de la venta
            </title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <link rel="stylesheet" href="../../sass/main.css">
        </head>
        <body>

        <?php include("../../complementario/encabezado.php") ?>

            <section class="container my-5 section-detail shadow">
        
                    <div class="text-center mb-4">
                        <h3 class="detail-title">Venta</h3>
                    </div>
            
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label for="monto" class="form-label">Monto</label>
                            <input class="form-control" type="text" id="monto" value="<?php echo $fila['monto']; ?>" disabled>
                        </div>
            
                        <div class="col-6 col-md-2">
                            <label for="entregado" class="form-label">Entregado</label>
                            <input class="form-control" type="text" id="entregado" value="<?php echo (isset($fila['entregado']) && $fila['entregado'] > 0) ? 'Sí' : 'No'; ?>" disabled>
                        </div>
            
                        <div class="col-6 col-md-2">
                            <label for="pagado" class="form-label">Pagado</label>
                            <input class="form-control" type="text" id="pagado" value="<?php echo (isset($fila['pagado']) && $fila['pagado'] > 0) ? 'Sí' : 'No'; ?>" disabled>
                        </div>
            
                        <div class="col-12 col-md-4">
                            <label for="fecha_venta" class="form-label">Fecha de la venta</label>
                            <input class="form-control" type="text" id="fecha_venta" value="<?php echo $fila['fecha_venta']; ?>" disabled>
                        </div>
            
                        <div class="col-12">
                            <label for="vendedor" class="form-label">Nombre y apellido del vendedor</label>
                            <input class="form-control" type="text" id="vendedor" value="<?php echo $fila['nombreyapellido']; ?>" disabled>
                        </div>
                    </div>
            
                    <div class="text-center my-4 pt-3 border-top border-secondary-subtle">
                        <h4 class="detail-title fs-4">Detalles de la venta</h4>
                    </div>
            
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label for="nombre_producto" class="form-label">Nombre del producto</label>
                            <input class="form-control" type="text" id="nombre_producto" value="<?php echo $fila['nombre_producto']; ?>" disabled>
                        </div>
            
                        <div class="col-12 col-md-6">
                            <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                            <input class="form-control" type="text" id="fecha_entrega" value="<?php echo $fila['fecha_entrega']; ?>" disabled>
                        </div>
            
                        <div class="col-12 col-md-4">
                            <label for="precio_bruto" class="form-label">Precio bruto</label>
                            <input class="form-control" type="text" id="precio_bruto" value="<?php echo $fila['precio_bruto']; ?>" disabled>
                        </div>
            
                        <div class="col-12 col-md-4">
                            <label for="cant_prod" class="form-label">Cantidad de productos</label>
                            <input class="form-control" type="text" id="cant_prod" value="<?php echo $fila['cant_prod']; ?>" disabled>
                        </div>
            
                        <div class="col-12 col-md-4">
                            <label for="ganancia" class="form-label">Ganancia</label>
                            <input class="form-control" type="text" id="ganancia" value="<?php echo $fila['ganancia']; ?>" disabled>
                        </div>
                    </div>
            
                    <div class="detail-actions d-flex justify-content-between align-items-center mt-5 pt-4">
                        <form action="form.php" method="post">
                            <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila['id_venta']; ?>">
                            <button class="btn btn-edit" type="submit">Editar</button>
                        </form>
            
                        <form action="../../publico/acciones/ventas/eliminar.php" method="post">
                            <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila['id_venta']; ?>">
                            <button class="btn btn-del" type="submit" onclick="return confirm('¿Estás seguro de eliminar esta venta?');">Eliminar</button>
                        </form>
                    </div>
            
                <?php if (isset($_GET["mensaje"])): ?>
                    <div class="text-center mt-4">
                        <div class="alert alert-success" role="alert">
                            <strong><?php echo $_GET["mensaje"]; ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

            </section>

    <div class="m-4 p-4"></div>
    <!-- // -->
    <?php include("../../complementario/pie.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>

<?php
    }else {
        header("Location: ../../complementario/error404.php");
    }
    exit;
?>