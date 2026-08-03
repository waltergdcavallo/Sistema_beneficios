<?php

    require_once "../../../conexion.php";

    if(!empty($_POST['nombre']) &&
    !empty($_POST['precio']) &&
    !empty($_POST['stock_inicial']) &&
    !empty($_POST['stock_actual']) &&
    !empty($_POST['id_beneficio'])){

        $id_producto=$_POST['id_producto'];
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $stock_inicial=$_POST['stock_inicial'];
        $stock_actual=$_POST['stock_actual'];
        $id_beneficio=$_POST['id_beneficio'];

        $sql="update producto set nombre=?, precio=?, stock_inicial=?, stock_actual=?, id_beneficio=? where id_producto=?";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("siiiii", $nombre, $precio, $stock_inicial, $stock_actual, $id_beneficio, $id_producto);

        if ($stmt->execute()){
            header("Location:../../../vistas/beneficios/lista.php?mensaje=ok");
        } else{
            $error.="Error en la edición";
            header("Location:../../../vistas/beneficios/lista.php?mensaje=".$error);
        }

    } else{
        $error.="Faltan datos";
        header("Location:../../../vistas/beneficios/lista.php?mensaje=".$error);
    }
?>