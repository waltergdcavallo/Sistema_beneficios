<?php

    require_once "../../../conexion.php";

    if(!empty($_POST['nombre']) && !empty($_POST['precio']) && !empty($_POST['stock_inicial']) && !empty($_POST['stock_actual']) && !empty($_POST['id_beneficio'])){

        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $stock_inicial=$_POST['stock_inicial'];
        $stock_actual=$_POST['stock_actual'];
        $id_beneficio=$_POST['id_beneficio'];

        $sql="insert into producto(nombre, precio, stock_inicial, stock_actual, id_beneficio) values (?, ?, ?, ?, ?)";

        $stmt=$conex->prepare($sql);

        $stmt->bind_param("ssssi", $nombre, $precio, $stock_inicial, $stock_actual, $id_beneficio);

        if ($stmt->execute()){
            header("Location:../../../vistas/productos/form.php?mensaje=ok");
        } else{
            $error.="Error en la inserción";
            header("Location:../../../vistas/productos/form.php?mensaje=".$error);
        }
    } else{
            $error.="Faltan datos";
            header("Location:../../../vistas/productos/form.php?mensaje=".$error);
        }
?>