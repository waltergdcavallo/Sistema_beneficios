<?php
    require_once "../../../conexion.php";

    $id_usuario=$_POST['id_usuario'];

    $sql="delete from usuario where id_usuario=?";

    $stmt=$conex->prepare($sql);

    $stmt->bind_param("i", $id_usuario);

    $stmt->execute();

    if ($stmt->execute()){
        header("Location:../../../vistas/usuarios/lista.php?mensaje=ok");
    } else{
        $error.="Error en la eliminación";
        header("Location:../../../vistas/usuarios/detalle.php?mensaje=".$error);
    }

?>