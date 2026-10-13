<?php

    require_once "../../../conexion.php";

    if(!empty($_POST['id_usuario']) &&
    !empty($_POST['id_beneficio'])){
    
        $id_usuario=$_POST['id_usuario'];
        $id_beneficio=$_POST['id_beneficio'];

        $sql="insert into historial(id_usuario, id_beneficio, fecha_inscripto) values (?, ?, CURDATE())";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("ii", $id_usuario, $id_beneficio);

        if ($stmt->execute()){
            header("Location:../../../vistas/inicio.php?mensaje=creado");
        } else{
            header("Location:../../vistas/inicio.php?mensaje=error1");
        }

    } else{
        header("Location:../../../vistas/inicio.php?mensaje=error1");
    }
?>