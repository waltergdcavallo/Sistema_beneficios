<?php
    require_once "../../../conexion.php";


    // admin
    if(!empty($_POST['id_usuario']) && 
    !empty($_POST['nombre']) && 
    !empty($_POST['apellido']) && 
    !empty($_POST['dni']) && 
    !empty($_POST['telefono']) && 
    !empty($_POST['email']) && 
    !empty($_POST['rol'])){

        $id_usuario=$_POST['id_usuario'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $direccion=$_POST['direccion'];
        $rol=$_POST['rol'];

        if (!empty($_POST['password_hash'])) {
            $password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
    
            $sql = "UPDATE usuario SET nombre = ?, apellido = ?, dni = ?, telefono = ?, email = ?, direccion = ?, password_hash = ?, rol = ? WHERE id_usuario = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("ssssssssi", $nombre, $apellido, $dni, $telefono, $email, $direccion, $password_hash, $rol, $id_usuario);

            if ($stmt->execute()){
                header("Location:../../../vistas/usuarios/lista.php?mensaje=editado");
            } else{
                header("Location:../../../vistas/usuarios/form.php?mensaje=error1");
            }
        } else {
            $sql = "UPDATE usuario SET nombre = ?, apellido = ?, dni = ?, telefono = ?, email = ?, direccion = ?, rol = ? WHERE id_usuario = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("sssssssi", $nombre, $apellido, $dni, $telefono, $email, $direccion, $rol, $id_usuario);

            if ($stmt->execute()){
                header("Location:../../../vistas/usuarios/lista.php?mensaje=editado");
            } else{
                header("Location:../../../vistas/usuarios/form.php?mensaje=error1");
            }
        }

    // vendedor y pendiente
    }elseif(!empty($_POST['id_usuario']) && 
    !empty($_POST['nombre']) && 
    !empty($_POST['apellido']) && 
    !empty($_POST['telefono'])){

        $id_usuario=$_POST['id_usuario'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $telefono=$_POST['telefono'];
        $direccion=$_POST['direccion'];

        if (!empty($_POST['password_hash'])) {
            $password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
    
            $sql = "UPDATE usuario SET nombre = ?, apellido = ?, telefono = ?, direccion = ?, password_hash = ? WHERE id_usuario = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("sssssi", $nombre, $apellido, $telefono, $direccion, $password_hash, $id_usuario);

            if ($stmt->execute()){
                header("Location:../../../vistas/usuarios/detalle.php?mensaje=editado");
            } else{
                header("Location:../../../vistas/usuarios/form.php?mensaje=error1");
            }
        } else {
            $sql = "UPDATE usuario SET nombre = ?, apellido = ?, telefono = ?, direccion = ? WHERE id_usuario = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("ssssi", $nombre, $apellido, $telefono, $direccion, $id_usuario);

            if ($stmt->execute()){
                header("Location:../../../vistas/usuarios/detalle.php?mensaje=editado");
            } else{
                header("Location:../../../vistas/usuarios/form.php?mensaje=error1");
            }
        }

    } else {
        header("Location:../../../vistas/usuarios/lista.php?mensaje=error2");
        exit;
    }
    
?>