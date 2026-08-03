<?php
    require_once "../../../conexion.php";

    $id_beneficio=$_POST['id_beneficio'];

    $sql="delete from beneficio where id_beneficio=?";

    $stmt=$conex->prepare($sql);

    $stmt->bind_param("i", $id_beneficio);

    $stmt->execute();

    if ($stmt->execute()){
        header("Location:../../../vistas/beneficios/lista.php?mensaje=ok");
    } else{
        $error.="Error en la eliminación";
        header("Location:../../../vistas/beneficios/lista.php?mensaje=".$error);
    }

?>