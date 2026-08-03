<?php

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
    <link rel="stylesheet" href="../../sass/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
     
    <section class="container">

        <div class="text-center my-5 text text-primary">
            <h3>Producto</h3>
        </div>
    
        <div class="row">

            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input class="form-control" type="text" value="<?php echo $fila['nombre'];?>" aria-label="Disabled input example" disabled>
            </div>

            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">Precio unitario</label>
                <input class="form-control" type="text" value="<?php echo $fila['precio'];?>" aria-label="Disabled input example" disabled>
            </div>

            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">Stock inicial</label>
                <input class="form-control" type="text" value="<?php echo $fila['stock_inicial'];?>" aria-label="Disabled input example" disabled>
            </div>

            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">Stock actual</label>
                <input class="form-control" type="text" value="<?php echo $fila['stock_actual'];?>" aria-label="Disabled input example" disabled>
            </div>
            <div class="mb-3 col-6">
                <form action="../beneficios/detalle.php" method="post">
                    <label for="exampleFormControlInput1" class="form-label">Beneficio asociado</label>
                    <input class="form-control" type="text" value="<?php echo $fila['nombrebeneficio'];?>" aria-label="Disabled input example" disabled>
                    <input type="hidden" class="form-control" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio'];?>">
                    <button class="btn btn-primary p-1 col-1e" type="submit">ver</button>
                </form>
            </div>
            <div class="text-center">
                <div class="d-sm-inline-block">
                    <form action="form.php" method="post">
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $fila["id_producto"];?>">
                        <button class="btn btn-primary p-1" type="submit">Editar</button>
                    </form>
                </div>
                <div class="d-sm-inline-block">
                    <form action="../../publico/acciones/beneficios/eliminar.php" method="post">
                        <input type="hidden"name="id_producto" id="id_producto" value="<?php echo $fila["id_producto"];?>">
                        <button class="btn btn-danger p-1" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>    
        </div>
    
    </section>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>