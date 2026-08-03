<?php
    session_start();

    require_once "../../../conexion.php";

    $email=$_POST["email"];
    $password_hash=$_POST["password_hash"];

    $sql="Select * from usuario where email=?";

    $stmt=$conex->prepare($sql);

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $resultado=$stmt->get_result();

    if ($resultado->num_rows==1){

        $fila=$resultado->fetch_assoc();

        if(!password_verify($password_hash, $fila['password_hash'])){

            $_SESSION["error"]="Datos Incorrectos";   
            header("Location:../../../vistas/sesion/login.php?");
            exit;
        }
        //admin
        if ($fila["rol"]=="admin"){

            $_SESSION['id_usuario']=$fila['id_usuario'];
            $_SESSION["nombreyapellido"]=$fila["nombre"]." ".$fila["apellido"];
            $_SESSION["dni"]=$fila["dni"];
            $_SESSION["telefono"]=$fila["telefono"];
            $_SESSION["email"]=$fila["email"];
            $_SESSION["direccion"]=$fila["direccion"];
            $_SESSION["password_hash"]=$fila["password_hash"];
            $_SESSION["rol"]=$fila["rol"];
        //vendedor
        }elseif($fila["rol"]=="vendedor"){

            $_SESSION['id_usuario']=$fila['id_usuario'];
            $_SESSION["nombreyapellido"]=$fila["nombre"]." ".$fila["apellido"];
            $_SESSION["dni"]=$fila["dni"];
            $_SESSION["telefono"]=$fila["telefono"];
            $_SESSION["email"]=$fila["email"];
            $_SESSION["direccion"]=$fila["direccion"];
            $_SESSION["password_hash"]=$fila["password_hash"];
            $_SESSION["rol"]=$fila["rol"];
        //pendiente
        }elseif($fila["rol"]=="pendiente"){

            $_SESSION['id_usuario']=$fila['id_usuario'];
            $_SESSION["nombreyapellido"]=$fila["nombre"]." ".$fila["apellido"] ;
            $_SESSION["dni"]=$fila["dni"];
            $_SESSION["telefono"]=$fila["telefono"];
            $_SESSION["email"]=$fila["email"];
            $_SESSION["direccion"]=$fila["direccion"];
            $_SESSION["password_hash"]=$fila["password_hash"];
            $_SESSION["rol"]=$fila["rol"];

        }
        header("Location:../../../vistas/inicio.php");
        exit;

    }else{

        $_SESSION["error"]="Datos Incorrectos";   
        header("Location:../../../vistas/sesion/login.php?");
        exit;

    }


?>