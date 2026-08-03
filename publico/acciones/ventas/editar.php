<?php

    require_once "../../../conexion.php";

        if(!empty($_POST['id_venta']) && 
        !empty($_POST['monto']) && 
        !empty($_POST['fecha_venta'])){

        $id_venta=$_POST['id_venta'];
        $monto=$_POST['monto'];
        $entregado=$_POST['entregado'];
        $pagado=$_POST['pagado'];
        $fecha_venta=$_POST['fecha_venta'];

        $sql_venta="update venta set monto=?, entregado=?, pagado=?, fecha_venta=? where id_venta=?";

        $stmt_venta=$conex->prepare($sql_venta);

        $stmt_venta->bind_param("ssssi", $monto, $entregado, $pagado, $fecha_venta, $id_venta);

        if ($stmt_venta->execute()){

            $id_detalle_venta=$_POST['id_detalle_venta'];
            $id_producto=$_POST['id_producto'];
            $cant_prod=$_POST['cant_prod'];
            $fecha_entrega=$_POST['fecha_entrega'];

            $sql_detalle="update detalle_venta set id_producto=?, cant_prod=?, fecha_entrega=? where id_detalle_venta=?";

            $stmt_detalle=$conex->prepare($sql_detalle);

            $stmt_detalle->bind_param("issi", $id_producto, $cant_prod, $fecha_entrega, $id_detalle_venta);

            if ($stmt_detalle->execute()){
                header("Location:../../../vistas/ventas/lista.php?mensaje=ok");
            } else{
                $error.="Error en la edición";
                header("Location:../../../vistas/ventas/lista.php?mensaje=".$error);
            }

        } else{
            $error.="Error en la edición";
            header("Location:../../../vistas/ventas/lista.php?mensaje=".$error);
        }
    } else{
        $error.="Faltan datos";
        header("Location:../../../vistas/ventas/lista.php?mensaje=".$error);
    }
?>