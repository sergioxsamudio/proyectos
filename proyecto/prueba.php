<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $mysqli = include_once "conexionDB.php";
    
    $user = 'daniel.hernandez-c@uniminuto.edu.co';
    $resultado = $mysqli->query("SELECT MAX('idUsuario') FROM usuario");
    $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);


    ?>
<?php
foreach ($usuarios as $usuarios){?>
    <h1><?php echo $usuarios["primerNombre"] ?></h1>
<?php }?>
</body>

</html>