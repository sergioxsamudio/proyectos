<?php

$host = "localhost";
$usuario = "root";
$password = "";
$base_de_datos = "proyecto";

$mysqli = new mysqli($host, $usuario, $password, $base_de_datos);
if ($mysqli->connect_errno) {
    echo "Fallo la conexion a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}
return $mysqli;
?>

