<?php
$host = "localhost";
$usuario = "root";
$pass = "";
$bd = "sistema_beneficios";

$conex = new mysqli($host, $usuario, $pass, $bd);

if ($conex->connect_error) {
    die("Error de conexión: " . $conex->connect_error);
}

$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$carpeta_base = "/sistema_beneficios";

if (!defined('BASE_URL')) {
    define('BASE_URL', $protocolo . $host . $carpeta_base);
}

?>