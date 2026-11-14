<?php

    require_once "../../../conexion.php";

    if(!empty($_POST['nombre']) &&
    !empty($_POST['fecha_inicio']) &&
    !empty($_POST['fecha_fin']) &&
    !empty($_POST['creador']) &&
    !empty($_POST['descripcion'])){
    
        $nombre=$_POST['nombre'];
        $fecha_inicio=$_POST['fecha_inicio'];
        $fecha_fin=$_POST['fecha_fin'];
        $estado=$_POST['estado'];
        $estado=$_POST['creador'];
        $descripcion=$_POST['descripcion'];

        $sql="insert into beneficio(nombre, fecha_inicio, fecha_fin, estado, creador, descripcion) values (?, ?, ?, ?, ?, ?)";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("sssiss", $nombre, $fecha_inicio, $fecha_fin, $estado, $creador, $descripcion);

        if ($stmt->execute()){
            header("Location:../../../vistas/beneficios/lista.php?mensaje=creado");
        } else{
            header("Location:../../vistas/beneficios/form.php?mensaje=error1");
        }

    } else{
        header("Location:../../../vistas/beneficios/form.php?mensaje=error2");
    }
?>