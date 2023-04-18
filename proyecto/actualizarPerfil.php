
<?php
$mysqli = include_once "conexionDB.php";
$idUsuarios = $_POST["idUsuarios"];
$primerNombre = $_POST["primerNombre"];
$segundoNombre = $_POST["segundoNombre"];
$primerApellido = $_POST["primerApellido"];
$segundoApellido = $_POST["segundoApellido"];
$descripcion = $_POST["descripcion"];
$item1 = $_REQUEST['item1'];
$item2 = $_REQUEST['item2'];
$item3 = $_REQUEST['item3'];
$Contraseña = $_POST["Contraseña"];


$sentencia = $mysqli->prepare("UPDATE usuario SET
    primer_nombre = ?,
    segundo_nombre = ?,
    primer_apellido = ?,
    segundo_apellido = ?,
    descripcion = ?,
    item1 = ?,
    item2 = ?,
    item3 = ?,
    contraseña = ?
    WHERE id_usuario = ?");
$sentencia->bind_param("ssssssssss", $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $descripcion, $item1, $item2, $item3, $Contraseña, $idUsuarios );
$sentencia->execute();
$mensaje = "Se ha actualizado el perfil";
echo "<script>";
echo "alert('$mensaje');";
echo "window.location = 'perfil.php';";
echo "</script>";
echo "<script type='text/javascript'>alert('$msg');</script>";
?>


<?php include("includes/footer.php") ?>



