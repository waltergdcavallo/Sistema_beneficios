<?php
    require_once "../../../conexion.php";

    $id_producto=$_POST['id_producto'];

    $sql="delete from producto where id_producto=?";

    $stmt=$conex->prepare($sql);

    $stmt->bind_param("i", $id_producto);

    $stmt->execute();

    if ($stmt->execute()){
        header("Location:../../../vistas/beneficios/detalle.php?mensaje=eliminado");
    } else{
        $error.="Error en la eliminación";
        header("Location:../../../vistas/productos/detalle.php?mensaje=error1");
    }

?>