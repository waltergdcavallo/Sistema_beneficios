

<!-- // -->
<?php

    session_start();
    //admin
    
    if(isset($_SESSION['rol']) && !empty($_SESSION['rol'])){

        require_once "../conexion.php";
        
        if($_SESSION['rol'] =="admin"){
            $sql="SELECT id_beneficio, nombre FROM beneficio WHERE estado=1  ORDER BY fecha_inicio DESC";
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

                    <section class="container p-5 my-3">
                        <p class="mb-5 title-list">
                            <?php echo 'Panel de Control y Supervisión General'; ?>
                        </p>

                        <div class="div-form mb-3 text-center">
                            <h1 class="display-6 fw-bold mb-2">¡Bienvenido, <?php echo $_SESSION['nombreyapellido']; ?>!</h1>
                        </div>
                    </section>

                        
                        <section class="container-fluid px-5 my-5">
                            <div class="row justify-content-center align-items-start">
                                <section class="col-10 col-xxl-6 section-dashboard mb-5 mx-5">
                                    <div class="mb-4">
                                        <h3>Listado de beneficios disponibles</h3>
                                    </div>
                                     <?php if (isset($_GET['mensaje'])){ ?>
                                                <?php if ($_GET['mensaje'] == 'creado'){ ?>
                                                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                        <strong>¡Éxito!</strong> Registrado correctamente.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php }elseif ($_GET['mensaje'] == 'error1'){ ?>
                                                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                                                        <strong>¡Error!</strong> Hubo un problema al registrarse. Inténtalo más tarde.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php } ?>
                                             <?php } ?>
        
                                <div class="d-flex justify-content-center gap-2 mb-5">
                                    <button type="button" id="todo" onclick="filtrarbeneficios('todo')" class="btn btn-confirm px-4 py-2 rounded-pill">
                                        Todos los activos
                                    </button>
                                    <button type="button" id="mio" onclick="filtrarbeneficios('mio')" class="btn btn-register px-4 py-2 rounded-pill">
                                        Mis beneficios
                                    </button>
                                </div>
                                <div class="row justify-content-center g-4">
                                    <!-- // -->
                                    <?php
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) { 
                                        
                                            $sql2 = "SELECT * FROM historial WHERE id_beneficio=? AND id_usuario=?";
                                            $stmt2 = $conex->prepare($sql2);
                                            $beneficio = $fila['id_beneficio'];
                                            $usuario = $_SESSION['id_usuario'];
                                            $stmt2->bind_param("ii", $beneficio, $usuario);
                                            $stmt2->execute();
                                            $resultado2 = $stmt2->get_result();
                                            ?>
                                            
                                            <div class="col-12 col-md-6 col-lg-4 card-beneficio" filtro="<?php if($resultado2->num_rows > 0){ echo "true";}else{ echo "false";}?>">
                                                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 transition-card card-list">
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <div>
                                                        <h4 class="card-title fw-bold text-dark mb-2">Beneficio <?php echo $fila['nombre']; ?></h4>
                                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                                                                    Activo
                                                                </span>
                                                                <!-- // -->
                                                                <?php if ($resultado2->num_rows > 0){ ?>
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <a href="ventas/form.php?id_beneficio=<?php echo $fila['id_beneficio']; ?>" class="btn btn-sm btn-confirm px-3 py-1 rounded-pill">Vender</a>
                                                                    </div>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                        <!-- // -->
                                                        <?php
                                                        
                                                        if ($resultado2->num_rows > 0) {
                                                            echo "<span class='badge bg-light text-dark border mb-2'>inscripto</span>";
                                                        } else { ?>
                                                            <form action="../publico/acciones/historial/crear.php" method="post">
                                                                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']?>">
                                                                <input type="hidden" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']?>">
                                                                <button type="submit" class="btn btn-register w-100 mb-1" onclick="return confirm('¿Estás seguro de anotarte?');">Anotarse</button>
                                                            </form>
                                                        <?php } ?>
                                                        <form action="../vistas/beneficios/detalle.php" method="post">
                                                            <input type="hidden" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']?>">
                                                            <button type="submit" class="btn btn-confirm w-100 py-2">
                                                                Ver detalle
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- // -->
                                        <?php 
                                        }
                                    } else {
                                        echo "<p class='col-12'>No existen beneficios activos por el momento</p>";
                                    }
                                    ?>
                                </div>
                            </section>

                            <section class="col-10 col-xxl-4 section-dashboard mb-5 mx-5 d-flex flex-column gap-4">
                                <?php $sql="SELECT venta.*, concat(usuario.nombre, ' ', usuario.apellido) AS nombreyapellido, beneficio.nombre FROM venta, usuario, beneficio, producto, detalle_venta WHERE (venta.id_usuario=usuario.id_usuario) AND (detalle_venta.id_venta=venta.id_venta) AND (detalle_venta.id_producto=producto.id_producto) AND (producto.id_beneficio=beneficio.id_beneficio) AND venta.fecha_venta=CURDATE() ORDER BY venta.fecha_venta DESC";
                                      $stmt=$conex->prepare($sql);
                                      if ($stmt->execute()){
                                          $resultado=$stmt->get_result();
                                }?>

                                <div class="mb-4">
                                    <h3>Listado de ventas en el dia</h3>
                                </div>

                                <section class="section-list">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Vendedor</th>
                                                <th scope="col">Beneficio</th>
                                                <th scope="col">Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        <!-- // -->
                                        <?php
                                            if($resultado->num_rows>0){
                                                while($fila=$resultado->fetch_assoc()){
    
                                        ?>
                                                    <tr>
                                                        <td><?php echo $fila["nombreyapellido"]; ?></td>
                                                        <td><?php echo $fila["nombre"]; ?></td>
                                                        <td>
                                                            <div class="d-sm-inline-block">
                                                                <form action="ventas/detalle.php" method="post">
                                                                    <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $fila["id_venta"];?>">
                                                                    <button class="btn btn-primary p-1" type="submit">Ver Detalle</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
    
                                        <!-- // -->
                                        <?php
                                            }
                                        }else{
                                        ?>
                                            <tr>
                                                <td scope="5"></td>
                                                <div class="alert alert-danger text-center">No existen Ventas de hoy</div>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </section>
                                <?php $sql="SELECT *, concat(nombre, ' ', apellido) AS nombreyapellido FROM usuario WHERE rol='pendiente' ORDER BY id_usuario DESC";
                                      $stmt=$conex->prepare($sql);
                                      if ($stmt->execute()){
                                          $resultado=$stmt->get_result();
                                }?>
                                <div class="mb-4">
                                    <h3>Nuevos usuarios</h3>
                                </div>
    
                                <section class="section-list">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre y apellido</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Rol</th>
                                                <th scope="col">Detalles</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                    
                                            <!-- // -->
                                            <?php
                                                if($resultado->num_rows>0){
                                                    while($fila=$resultado->fetch_assoc()){
                    
                                            ?>
                                                        <tr>
                                                            <td><?php echo $fila["nombreyapellido"]; ?></td>
                                                            <td><?php echo $fila["email"]; ?></td>
                                                            <td><?php echo$fila["rol"];?></td> 
                                                            <td>
                                                                <div class="d-sm-inline-block">
                                                                    <form action="usuarios/detalle.php" method="post">
                                                                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $fila["id_usuario"];?>">
                                                                        <button class="btn btn-primary p-1" type="submit">Ver Detalles</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                    
                                            <!-- // -->
                                            <?php
                                                }
                                            }else{
                                            ?>
                                                <tr>
                                                    <td scope="5"></td>
                                                    <div class="alert alert-danger text-center">No hay usuarios nuevos</div>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </section>
                            
                            <section class="col-lg-4 col-12 mb-5 mx-5"></section>
                        </div>
                    </section>
                    <div class="p-4 m-4"></div>
    <!-- // -->
    <?php include("../complementario/pie.php")?>
    <script> 
        function filtrarbeneficios(tipo){
            const tarjetas = document.querySelectorAll('.card-beneficio');
            const mio=document.getElementById("mio"); 
            const todo=document.getElementById("todo");

            if (tipo=="todo") {
                todo.className = "btn btn-confirm px-4 py-2 rounded-pill";
                mio.className = "btn btn-register px-4 py-2 rounded-pill";
            } else {
                mio.className = "btn btn-confirm px-4 py-2 rounded-pill";
                todo.className = "btn btn-register px-4 py-2 rounded-pill";
            }

            tarjetas.forEach(tarjeta => {
                const estaInscripto = tarjeta.getAttribute('filtro');
        
                if (tipo=="todo") {
                    tarjeta.style.display = 'block';
                } else if (tipo=="mio") {
                    if (estaInscripto === 'true') {
                        tarjeta.style.display = 'block';
                    } else {
                        tarjeta.style.display = 'none';
                    }
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
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

                        <section class="text-center container p-5 my-5 section-cards">
                            <div class="div-form mb-3">
                                <h3>Bienvenido <?php echo $_SESSION['nombreyapellido']?></h3>
                            </div>
                            <div class="mb-4">
                                <h5 class="h5">Listado de beneficios activos</h5>
                            </div>
                        
                            <div class="row g-4 justify-content-center">
                                <?php
                                if ($resultado->num_rows > 0) {
                                    while ($fila = $resultado->fetch_assoc()) { ?>
                                        
                                        <div class="col-12 col-md-4">
                                            <div class="card card-list h-100">
                                                <div class="card-body d-flex flex-column justify-content-between">
                                                    <div>
                                                        <h5 class="card-title">Beneficio <?php echo $fila['nombre']?></h5>
                                                        <p>Activo</p>
                                                    </div>
                        
                                                    <?php 
                                                    $sql2 = "SELECT * FROM historial WHERE id_beneficio=? AND id_usuario=?";
                                                    $beneficio = $fila['id_beneficio'];
                                                    $usuario = $_SESSION['id_usuario'];
                                                    $stmt2 = $conex->prepare($sql2);
                                                    $stmt2->bind_param("ii", $beneficio, $usuario);
                                                    $stmt2->execute();
                                                    $resultado2 = $stmt2->get_result();
                                                    
                                                    if ($resultado2->num_rows > 0) {
                                                        echo "<p class='text-success font-weight-bold'>inscripto</p>";
                                                    } else { ?> 
                                                        <form action="../publico/acciones/historial/crear.php" method="post">
                                                            <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']?>">
                                                            <input type="hidden" id="id_beneficio" name="id_beneficio" value="<?php echo $fila['id_beneficio']?>">
                                                            <button type="submit" class="btn button-confirm w-100">Anotarse al beneficio</button>
                                                        </form> 
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                        
                                    <?php 
                                    }
                                } else {
                                    echo "<p class='col-12'>No existen beneficios activos por el momento</p>";
                                }
                                ?>
                            </div>
                        </section>
    <!-- // -->
    <?php include("../complementario/pie.php")?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
                
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
                                    <h1 class="h5">Bienvendo, espera a que un administrador de acceso a tu cuenta.</h1>
                                </div>
                            </div>
                        </section>

    <!-- // -->
    <?php include("../complementario/pie.php")?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
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
    
        <section class="container my-5 py-4">
            <div class="row align-items-center g-5 dashboard-no-logged">
        
                <div class="col-12 col-lg-6 mb-5">
                    
                    <div class="tag mb-3">
                        <span></span> SISTEMA DE GESTIÓN
                    </div>
        
                    <h1 class="mb-3 title-welcome">
                        ¡Te damos la bienvenida! <span>Accedé a todas tus acciones en un solo lugar.</span>
                    </h1>
        
                    <p class="description mb-4">
                        Este sistema busca la gestión integral de beneficios, ventas, productos y usuarios de manera ágil, sencilla e intuitiva.
                    </p>
        
                    <div class="d-flex flex-wrap gap-3">
                        <a href="../vistas/usuarios/form.php" class="btn btn-register">Registrarse</a>
                    </div>
                </div>
        
                <div class="col-12 col-lg-6" id="modulos">
                    <div class="info-card p-4 p-md-5 shadow">
                        
                        <span class="card-subtitle d-block mb-4">MÓDULOS DEL SISTEMA</span>
        
                        <div class="card-item d-flex gap-3 mb-4">
                            <div class="num">01</div>
                            <div class="content">
                                <h4>Ventas</h4>
                                <p>Administrar ventas de manera dinámica e intuitiva.</p>
                            </div>
                        </div>
        
                        <div class="card-item d-flex gap-3 mb-4">
                            <div class="num">02</div>
                            <div class="content">
                                <h4>Usuarios</h4>
                                <p>Crear usuarios con sus respectivos roles y datos centralizados.</p>
                            </div>
                        </div>
        
                        <div class="card-item d-flex gap-3">
                            <div class="num">03</div>
                            <div class="content">
                                <h4>Productos</h4>
                                <p>Gestionar productos con control de stock, precios y más.</p>
                            </div>
                        </div>
        
                    </div>
                </div>
        
            </div>
        </section>

        <section class="container my-5 py-4">
        
            <div class="mb-5 text-start title-welcome-2">
                <h2>Cómo funciona</h2>
                <p>Tres pasos para una gestión integral de beneficios y ventas.</p>
            </div>

            <div class="row g-4">
        
                <div class="col-12 col-md-4">
                    <div class="card-item-2 shadow-sm">
                        <div>01</div>
                        <h3>Registrá tus productos y beneficios</h3>
                        <p>
                            Cargá los artículos disponibles, asigná sus precios y vinculalos con los beneficios activos para tu comunidad.
                        </p>
                    </div>
                </div>
        
                <div class="col-12 col-md-4">
                    <div class="card-item-2 shadow-sm">
                        <div>02</div>
                        <h3>Gestioná usuarios y roles</h3>
                        <p>
                            Da de alta vendedores y administradores con permisos personalizados para mantener un control claro del flujo de trabajo.
                        </p>
                    </div>
                </div>
        
                <div class="col-12 col-md-4">
                    <div class="card-item-2 shadow-sm">
                        <div>03</div>
                        <h3>Registrá ventas y monitoreá</h3>
                        <p>
                            Asigná beneficios a los clientes, registrá estados de pago/entrega y mantené el control del stock en tiempo real.
                        </p>
                    </div>
                </div>
        
            </div>
        
        </section>

        <section class="container my-5 py-4">

            <div class="mb-4 text-start title-quest">
                <h2>Preguntas frecuentes</h2>
                <p>Restricciones y reglas generales para el uso del sistema.</p>
            </div>
        
            <div class="accordion row g-3 g-md-4" id="faqAccordion">
        
                <div class="col-12 col-md-6 d-flex flex-column gap-3">
        
                    <div class="accordion-item section-quest shadow-sm">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                ¿Quiénes pueden crear o editar productos y beneficios?
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Solo los usuarios con rol de <strong>Administrador</strong> tienen permisos para crear, modificar o eliminar productos y beneficios. Los usuarios con rol Vendedor solo tienen acceso de lectura para la selección en ventas.
                            </div>
                        </div>
                    </div>
        
                    <div class="accordion-item section-quest shadow-sm">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                ¿Qué restricciones tienen los usuarios con rol "Pendiente"?
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Los usuarios recién registrados quedan automáticamente en estado <strong>Pendiente</strong>. No podrán acceder a los módulos de ventas, usuarios ni productos hasta que un Administrador apruebe su cuenta y les asigne un rol activo.
                            </div>
                        </div>
                    </div>
        
                    <div class="accordion-item section-quest shadow-sm">
                        <h3 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                ¿Se pueden eliminar productos o beneficios con historial de ventas?
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Para preservar la integridad de la base de datos y los reportes financieros, el sistema impide la eliminación física de registros vinculados a ventas activas. Se recomienda cambiar el estado del beneficio a <strong>Terminado</strong> o dejar el stock en cero.
                            </div>
                        </div>
                    </div>
        
                </div>
        
                <div class="col-12 col-md-6 d-flex flex-column gap-3">
        
                    <div class="accordion-item section-quest shadow-sm">
                        <h3 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                ¿Qué sucede cuando el stock actual de un producto llega a cero?
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Cuando el stock llega a 0, el producto se deshabilita automáticamente en el selector de "Crear venta" para evitar sobreventas, notificando que no existen unidades disponibles para vincular.
                            </div>
                        </div>
                    </div>
        
                    <div class="accordion-item section-quest shadow-sm">
                        <h3 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                ¿Un vendedor puede modificar el monto o eliminar ventas de otros usuarios?
                            </button>
                        </h3>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No. Los vendedores únicamente pueden visualizar y modificar los estados de entrega o pago de sus propias ventas registradas. La eliminación o reasignación de ventas es facultad exclusiva del rol Administrador.
                            </div>
                        </div>
                    </div>
        
                </div>
        
            </div>
        
        </section>

<!-- // -->
    <?php include("../complementario/pie.php")?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<!-- // -->
<?php
    }
?>