<!DOCTYPE html>
<?php include("includes/header.php") ?>
<?php

session_start();
$user = $_SESSION['correo'];
if (!isset($user)) {
    header("location: index.php");
}
?>


<html lang="en">

<?php
$mysqli = include_once "conexionDB.php";
$resultado = $mysqli->query("SELECT * FROM usuario");
$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

$user = strval($_SESSION['correo']);
$user = $mysqli->query("SELECT * FROM usuario WHERE correo='$user'");
foreach ($user as $user) {
    $cod = $user["id_usuario"];
    echo $cod;
}
require 'database/conexion.php';
    $db = new Database();
    $con = $db -> conectar();
if (isset($_POST['subir'])) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "documentos/" . $nombre;
    if ($nombre != "") {
        if (copy($ruta, $destino)) {
            $titulo= $_POST['titulo'];
            $descri= $_POST['descripcion'];
            $año= $_POST['año'];
            
            // insert con valor 1 en id estudiante OJO
            
            $sql = $con -> prepare ("INSERT INTO proyecto(id_estudiante,Nombre,descripción,año,ubicacion,estado_proyecto) VALUES($cod,'$titulo','$descri','$año','$destino','0')");
            $sql -> execute();
            }
    }
            $sql1 = $con -> prepare("SELECT MAX(`id_proyecto`) FROM `proyecto`;");
            $sql1 -> execute();
            $resultado = $sql1 -> fetch(PDO::FETCH_ASSOC);
           $nresultado = implode("",$resultado);
            $nombrenuevo = $nresultado;
            rename ($destino,"documentos/$nombrenuevo.pdf");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="width: 500px;margin: auto;border: 1px solid blue;padding: 30px;">
            <h4>Subir PDF</h4>
            <form method="post" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label>Titulo</label></td>
                        <td><input type="text" name="titulo"></td>
                    </tr>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><textarea name="descripcion"></textarea></td>
                    </tr>
                     <tr>
                        <td><label>Año</label></td>
                        <td><input type="text" name="año"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="file" name="archivo"></td>
                    <tr>
                        <td><input type="submit" value="Subir" name="subir"></td>
                        
                    </tr>
                </table>
            </form>            
        </div>
    </body>
</html>
