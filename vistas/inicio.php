

<!-- // -->
<?php

    session_start();
    //admin
    
    if(isset($_SESSION['rol']) && !empty($_SESSION['rol'])){

        require_once "../conexion.php";
        
        if($_SESSION['rol'] =="admin"){
            $sql="select id_beneficio, nombre from beneficio where estado=1";
            $stmt=$conex->prepare($sql);
            if($stmt->execute()){
                $resultado=$stmt->get_result();
            }
?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Bienvenido</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                <link rel="stylesheet" href="../sass/main.css"> 
            </head>
                <body>

                <!-- // -->
                <?php include("../complementario/encabezado.php")?>

                    <section class="text-center container p-5 my-5 section">
                        <div class="row">
                            <div class="div-form">
                                <h3>Bienvendo <?php echo $_SESSION['nombreyapellido']?></h3>
                            </div>
                            <div>
                                <h5>Listado de beneficios</h5>
                            </div>
                        </div>
                        <?php
                                if($resultado->num_rows>0){
                                    while($fila=$resultado->fetch_assoc()){?>
                                        <div class="card card-list col-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Beneficio <?php echo $fila['nombre']?></h5>
                                                <p>Activo</p>
                                                <?php 
                                                $sql2="select * from historial where id_beneficio=? and id_usuario=?";
                                                $beneficio=$fila['id_beneficio'];
                                                $usuario=$_SESSION['id_usuario'];
                                                $stmt2=$conex->prepare($sql2);
                                                $stmt2->bind_param("ii", $beneficio, $usuario);
                                                $stmt2->execute();
                                                $resultado2=$stmt2->get_result();
                                                if($resultado2->num_rows>0){
                                                    echo "<p>inscripto</p>";
                                                }else{?> 
                                                    <form action="../publico/acciones/historial/crear.php" method="post">
                                                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']?>">
                                                        <input type="hidden" class="form-control" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']?>">
                                                        <button type="submit" class="btn button-confirm">Anotarse al beneficio</button>
                                                    </form> 
                                                <?php }?>
                                            </div>
                                        </div>
                            <?php 
                                    }
                                } else{
                                    echo "No existen beneficios activos por el momento";
                                }
                            ?>
                    </section>
<!-- // -->
<?php
            //vendedor
            } elseif($_SESSION['rol'] =="vendedor"){
                $sql="select id_beneficio, nombre from beneficio where estado=1";
                $stmt=$conex->prepare($sql);
                if($stmt->execute()){
                    $resultado=$stmt->get_result();
                }
?>
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Bienvenido</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                        <link rel="stylesheet" href="../../sass/main.css">
                    </head>
                    <body>

                        <?php include("../complementario/encabezado.php")?>

                        <section class="text-center container">
                            <div class="row">
                                <div class="col-6">
                                    <h1>Bienvendo <?php echo $_SESSION['nombreyapellido']?></h1>
                                </div>
                            </div>
                            <?php
                                if($resultado->num_rows>0){
                                    while($fila=$resultado->fetch_assoc()){?>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Beneficio <?php $fila['nombre']?></h5>
                                                <p>Activo</p>
                                                <?php 
                                                $sql2="select * from historial where id_beneficio=? and id_usuario=?";
                                                $stmt2=$conex->prepare($sql2);
                                                $stmt2->bind_param("ii", $fila['id_beneficio'], $_SESSION['id_usuario']);
                                                $stmt2->execute();
                                                $resultado2=$stmt2->get_result();
                                                if($resultado2->num_rows>0){
                                                    echo "inscripto";
                                                }else{?> 
                                                    <form action="../publico/acciones/historial/crear.php" method="post">
                                                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']?>">
                                                        <input type="hidden" class="form-control" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']?>">
                                                        <button type="submit" class="btn btn-primary">Anotarse al beneficio</button>
                                                    </form> 
                                                <?php }?>
                                            </div>
                                        </div>
                            <?php 
                                    }
                                } else{
                                    echo "No existen beneficios activos por el momento";
                                }
                            ?>
                        </section>
                
<!-- // -->
<?php
//pendiente
            } elseif($_SESSION['rol'] =="pendiente"){
?>
    
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Bienvenido</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
                        <link rel="stylesheet" href="../../sass/main.css">
                    </head>
                    <body>

                        <?php include("../complementario/encabezado.php")?>

                        <section class="mt-5 text-center container">
                            <div class="row">
                                <div class="col-12">
                                    <h1>Bienvendo, espera a que un administrador de acceso a tu cuenta.</h1>
                                </div>
                            </div>
                        </section>
<!-- // -->
<?php
            }

//no logueado
    } else{
?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bienvenido</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <link rel="stylesheet" href="../../sass/main.css">
        </head>
        <body>
    
        <?php include("../complementario/encabezado.php")?>
    
        <section class="container mt-5">
            <div class="div-title shadow">
                <div class="col-6 shadow text-center">
                    <h1>¡Te damos la bienvenida! Regístrate para acceder a las acciones</h1>
                    <p>Este sistema busca la gestión de beneficios, ventas, productos y usuarios</p>

                    <a href="../vistas/usuarios/form.php" class="btn button-cancel mt-5 p-3">Registrarse</a>
                </div>
            </div>
        </section>

        <section class="container section-cards mt-4">
            <div class="row">
                <div class="card card-beneficio1 col-3">
                    <div class="card-body">
                        <h2 class="card-title">Ventas</h2>
                        <p>Administrar ventas de manera dinámica e intuitiva</p>
                    </div>
                </div>
                <div class="card card-beneficio2 col-3">
                    <div class="card-body">
                        <h2 class="card-title">Usuarios</h2>
                        <p>Crear usuarios con sus respectivos roles y datos</p>
                    </div>
                </div>
                <div class="card card-beneficio3 col-3">
                    <div class="card-body">
                        <h2 class="card-title">Productos</h2>
                        <p>Gestionar productos con control de stock, precios y más</p>
                    </div>
                </div>
            </div>

        </section>
<?php
    }
?>

<?php include("../complementario/pie.php")?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>