<?php
$host = "localhost";
$usuario = "root";
$pass = "";
$bd = "sistema_beneficios";

$conex = new mysqli($host, $usuario, $pass, $bd);

if ($conex->connect_error) {
    die("Error de conexión: " . $conex->connect_error);
}
?>