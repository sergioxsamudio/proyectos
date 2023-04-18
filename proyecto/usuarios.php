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


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($usuarios as $usuarios) {
            if ($cod != $usuarios['id_usuario']) { ?>

                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img img width="500" height="500" src=<?php echo $usuarios["foto"] ?> class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $usuarios["primer_nombre"], " ",  $usuarios["segundo_nombre"], " ",  $usuarios["primer_apellido"], " ",  $usuarios["segundo_apellido"] ?></h5>
                                    <h6 class="card-title"><?php $pri = $usuarios['id_programa'];
                                                            $programm = $mysqli->query("SELECT * FROM programa WHERE id_programa ='$pri'");
                                                            foreach ($programm as $programm) {
                                                                echo $programm["Nombre"];
                                                            } ?></h6>
                                    <p class="card-text"><?php echo $usuarios["descripcion"] ?></p>
                                    <p class="card-text"><small class="text-muted"></small></p>
                                    <ul class="">
                                        <li class=""><?php echo $usuarios["item1"] ?></li>
                                        <li class=""><?php echo $usuarios["item2"] ?></li>
                                        <li class=""><?php echo $usuarios["item3"] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        }
        ?>
    </div>

</body>

</html>