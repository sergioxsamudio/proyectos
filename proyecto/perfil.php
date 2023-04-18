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
}
?>
<?php
$pri = $user['id_programa'];
$programm = $mysqli->query("SELECT * FROM programa WHERE id_programa ='$pri'");
foreach ($programm as $programm) {
    $nombrePro = $programm["Nombre"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card" style="width: 18rem;">
        <img img src=<?php echo $user["foto"] ?> class="img-fluid rounded-start">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user["primer_nombre"], " ",  $user["segundo_nombre"], " ",  $user["primer_apellido"], " ",  $user["segundo_apellido"] ?></h5>
            <h6 class="card-title"><?php echo $nombrePro; ?></h6>
            <p class="card-text"><?php echo $user["descripcion"] ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $user["item1"] ?></li>
            <li class="list-group-item"><?php echo $user["item2"] ?></li>
            <li class="list-group-item"><?php echo $user["item3"] ?></li>
        </ul>
        <div class="card-body">
            <a href="editarPerfil.php?idUsuarios=<?php echo $cod ?> "><input type="button" class="btn btn-primary" value="Editar"></a>
        </div>
    </div>
</body>

</html>