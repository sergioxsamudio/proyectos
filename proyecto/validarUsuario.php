<?php
include('conexionDB.php');

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['correo'] = $correo;



$consulta = "SELECT * FROM usuario WHERE correo='$correo' and contraseña='$contraseña'";
$resultado = mysqli_query($mysqli, $consulta);

$filas = mysqli_num_rows($resultado);
if ($filas) {
    header("location:home.php");
} else {
?>
    <?php
    header("location:index.html")

    ?>    
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
