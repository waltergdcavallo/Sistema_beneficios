<?php

    require_once "../../../conexion.php";

    if(!empty($_POST['nombre']) &&
    !empty($_POST['fecha_inicio']) &&
    !empty($_POST['fecha_fin']) &&
    !empty($_POST['descripcion'])){

        $id_beneficio=$_POST['id_beneficio'];
        $nombre=$_POST['nombre'];
        $fecha_inicio=$_POST['fecha_inicio'];
        $fecha_fin=$_POST['fecha_fin'];
        $estado=$_POST['estado'];
        $descripcion=$_POST['descripcion'];

        $sql="update beneficio set nombre=?, fecha_inicio=?, fecha_fin=?, estado=?, descripcion=? where id_beneficio=?";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("sssisi", $nombre, $fecha_inicio, $fecha_fin, $estado, $descripcion, $id_beneficio);


        if ($stmt->execute()){
            header("Location:../../../vistas/beneficios/lista.php?mensaje=ok");
        } else{
            $error.="Error en la edición";
            header("Location:../../../vistas/beneficios/form.php?mensaje=".$error);
        }
    } else{
        $error.="Error en la edición";
        header("Location:../../../vistas/beneficios/form.php?mensaje=".$error);
    }
?>