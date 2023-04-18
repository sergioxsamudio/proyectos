<!DOCTYPE html>
<?php include("includes/header.php") ?>
<?php $mysqli = include_once "conexionDB.php"?>

<html lang="en">

<?php
$idUsuarios = $_GET["idUsuarios"];
$sentencia = $mysqli->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
$sentencia->bind_param("s", $idUsuarios);
$sentencia->execute();
$resultado = $sentencia->get_result();
$user = $resultado->fetch_assoc();
if (!$user) {
    exit("No hay resultados para esa idUsuarios");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>

<center>
<body>
    <div class="contenedor_boostrap p-4">
        <div class="rows">
            <div class="col-md-4">

                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php session_unset();
                }   ?>


                <div class="card card-body">
                    <div class="card card-body">
                        <h5>Editar Perfil</h5>
                    </div>
                    <form action="actualizarPerfil.php" method="POST">
                    <div class="form_grup">
                    <input type="hidden" name="idUsuarios" value="<?php echo $user["id_usuario"] ?>">
                    </div>
                        <div class="form_grup">
                            <input type="text" name="primerNombre" value="<?php echo $user['primer_nombre']?>" class="form-control" placeholder="Primer Nombre">
                        </div>
                        <div class="form_grup">
                            <input type="text" name="segundoNombre" value="<?php echo $user['segundo_nombre']?>" class="form-control" placeholder="Segundo Nombre">
                        </div>
                        <div class="form_grup">
                            <input type="text" name="primerApellido" value="<?php echo $user['primer_apellido']?>" class="form-control" placeholder="Primer Aprellido">
                        </div>
                        <div class="form_grup">
                            <input type="text" name="segundoApellido" value="<?php echo $user['segundo_apellido']?>" class="form-control" placeholder="Segundo Apellido">
                        </div>
                        <div class="form_grup">
                            <input type="text" name="descripcion" value="<?php echo $user['descripcion']?>" class="form-control" placeholder="Descripcion">
                        </div>
                        <div class="form_grup">
                            <select name="item1" class="form-select" required>
                                <option value="<?php echo $user['item1']?>"><?php echo $user['item1']?></option>
                                <option value="Bases de datos">Bases de datos</option>
                                <option value="Geometria">Geometria</option>
                                <option value="Fisica">Fisica</option>
                                <option value="Programacion">Programacion</option>
                                <option value="Ingles">Ingles</option>
                                <option value="Artes">Artes</option>
                                <option value="Algebra lineal">Algebra lineal</option>
                            </select>
                        </div>
                        <div class="form_grup">
                            <select name="item2" class="form-select" required>
                            <option value="<?php echo $user['item2']?>"><?php echo $user['item2']?></option>
                                <option value="Bases de datos">Bases de datos</option>
                                <option value="Geometria">Geometria</option>
                                <option value="Fisica">Fisica</option>
                                <option value="Programacion">Programacion</option>
                                <option value="Ingles">Ingles</option>
                                <option value="Artes">Artes</option>
                                <option value="Algebra lineal">Algebra lineal</option>
                            </select>
                        </div>
                        <div class="form_grup">
                            <select name="item3" class="form-select" required>
                            <option value="<?php echo $user['item3']?>"><?php echo $user['item3']?></option>
                                <option value="Bases de datos">Bases de datos</option>
                                <option value="Geometria">Geometria</option>
                                <option value="Fisica">Fisica</option>
                                <option value="Programacion">Programacion</option>
                                <option value="Ingles">Ingles</option>
                                <option value="Artes">Artes</option>
                                <option value="Algebra lineal">Algebra lineal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="Contraseña" value="<?php echo $user['contraseña']?>" class="form-control" placeholder="Contraseña">
                        </div>
                    </div>
                    <button class="btn-success" name="editar">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</center>

</html>