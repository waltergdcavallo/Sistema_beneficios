<?php
    require_once "../../../conexion.php";


    // admin
    if(!empty($_POST['id_usuario']) && 
    !empty($_POST['nombre']) && 
    !empty($_POST['apellido']) && 
    !empty($_POST['dni']) && 
    !empty($_POST['telefono']) && 
    !empty($_POST['email']) && 
    !empty($_POST['password_hash']) && 
    !empty($_POST['rol'])){

        $id_usuario=$_POST['id_usuario'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $direccion=$_POST['direccion'];
        $password=$_POST['password_hash'];
        $rol=$_POST['rol'];
        $password_hash=password_hash($password, PASSWORD_DEFAULT);

        $sql="update usuario set nombre=?, apellido=?, dni=?, telefono=?, email=?, direccion=?, password_hash=?, rol=? where id_usuario=?";
        $stmt=$conex->prepare($sql);
        $stmt->bind_param("ssssssssi", $nombre, $apellido, $dni, $telefono, $email, $direccion, $password_hash, $rol, $id_usuario);
        if ($stmt->execute()){
            header("Location:../../../vistas/usuarios/lista.php?mensaje=ok");
        } else{
            $error.="Error en la edición";
            header("Location:../../../vistas/usuarios/form.php?mensaje=".$error);
            exit;
        }

    // vendedor y pendiente
    }elseif(!empty($_POST['id_usuario']) && 
    !empty($_POST['nombre']) && 
    !empty($_POST['apellido']) && 
    !empty($_POST['telefono']) && 
    !empty($_POST['password_hash'])){

        $id_usuario=$_POST['id_usuario'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $telefono=$_POST['telefono'];
        $direccion=$_POST['direccion'];
        $password=$_POST['password_hash'];
        $password_hash=password_hash($password, PASSWORD_DEFAULT);
        $sql="update usuario set nombre=?, apellido=?, telefono=?, direccion=?, password_hash=? where id_usuario=?";
        $stmt=$conex->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $apellido, $telefono, $direccion, $password_hash, $id_usuario);
        if ($stmt->execute()){
        header("Location:../../../vistas/usuarios/detalle.php?mensaje=ok");
        } else{
            $error.="Error en la edición";
            header("Location:../../../vistas/usuarios/form.php?mensaje=".$error);
        }
    } else {
        $error.="Faltan datos";
        header("Location:../../../vistas/usuarios/lista.php?mensaje=".$error);
        exit;
    }
    
?>