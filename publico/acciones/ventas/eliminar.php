<?php
    require_once "../../../conexion.php";

    $id_venta=$_POST['id_venta'];

    $id_detalle=$_POST['id_detalle_venta'];

    $sql_detalle="delete from detalle_venta where id_detalle_venta=?";

    $stmt_detalle=$conex->prepare($sql_detalle);

    $stmt_detalle->bind_param("i", $id_detalle);

    if ($stmt_detalle->execute()){

        $sql_venta="delete from venta where id_venta=?";

        $stmt_venta=$conex->prepare($sql);

        $stmt_venta->bind_param("i", $id_venta);

        if ($stmt_venta->execute()){
           header("Location:../../../vistas/ventas/lista.php?mensaje=ok");
        } else{
            $error.="Error en la eliminación";
            header("Location:../../../vistas/ventas/detalle.php?mensaje=".$error);
        }

        } else{
            $error.="Error en la eliminación";
            header("Location:../../../vistas/ventas/detalle.php?mensaje=".$error);
    }

?>