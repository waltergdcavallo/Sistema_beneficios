<?php

    require_once "../../../conexion.php";
    
    if(!empty($_POST['monto']) && 
    !empty($_POST['id_usuario']) &&
    !empty($_POST['fecha_venta']) && 
    !empty($_POST['id_producto']) &&
    !empty($_POST['cant_prod'])){

        $monto=$_POST['monto'];
        $entregado=$_POST['entregado'];
        $pagado=$_POST['pagado'];
        $fecha_venta=$_POST['fecha_venta'];
        $id_usuario=$_POST['id_usuario'];
        $id_producto=$_POST['id_producto'];
        $cant_prod=$_POST['cant_prod'];
        $fecha_entrega=$_POST['fecha_entrega'];

        $sql="insert into venta(monto, entregado, pagado, fecha_venta, id_usuario) values(?, ?, ?, ?, ?)";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("sssss", $monto, $entregado, $pagado, $fecha_venta, $id_usuario);

        if ($stmt->execute()){
            
            $id_venta=$conex->insert_id;
            $sql2="insert into detalle_venta(id_venta, id_producto, cant_prod, fecha_entrega) values(?, ?, ?, ?)";

            $stmt2=$conex->prepare($sql2);

            $stmt2->bind_param("iiis", $id_venta, $id_producto, $cant_prod, $fecha_entrega);

            if ($stmt2->execute()){
                header("Location:../../../vistas/ventas/form.php?mensaje=ok");
            } else{
                $error.="Error en la inserción";
                header("Location:../../../vistas/ventas/form.php?mensaje=".$error);
            }

        } else{
            $error.="Error en la inserción";
            header("Location:../../../vistas/ventas/form.php?mensaje=".$error);
        }
    } else {
        $error.="Faltan datos";
        header("Location:../../../vistas/ventas/form.php?mensaje=".$error);
        exit;
    }

?>