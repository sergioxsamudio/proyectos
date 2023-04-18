<!DOCTYPE html>
<html lang="en">

<?php
$mysqli = include_once "conexionDB.php";
$resultado = $mysqli->query("SELECT * FROM programa");
$programas = $resultado->fetch_all(MYSQLI_ASSOC);
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
                        <h5>Registro Usuario</h5>
                    </div>
                    <form action="registrarNewUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="form_grup">
                            <input type="text" name="primer_n" class="form-control" placeholder="Primer Nombre" required>
                        </div>
                        <div class="form_grup">
                            <input type="text" name="segundo_n" class="form-control" placeholder="Segundo Nombre" required>
                        </div>
                        <div class="form_grup">
                            <input type="text" name="apellido_p" class="form-control" placeholder="Apellido Paterno" required>
                        </div>
                        <div class="form_grup">
                            <input type="text" name="apellido_m" class="form-control" placeholder="Apellido Materno" required>
                        </div>
                        <div class="form_grup">
                            <input type="text" name="descrip" class="form-control" placeholder="Digite una descripción acerca de usted" required>
                        </div>
                        <div class="form_grup">
                            <input type="text" name="correo_user" class="form-control" placeholder="Correo" required>
                        </div>
                        <div class="form_grup">
                            <input type="password" name="Contraseña_user" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="form_grup">
                            <select name="program" class="form-select" required>
                                <option selected disabled value="">Seleccione el programa al cual pertenece</option>
                                <?php
                                foreach ($programas as $programas) { ?>
                                    <option value="<?php echo $programas["id_programa"] ?>"><?php echo $programas["Nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="file" name="foto"> <br/>
                        <input type="submit" class="btn btn-primary" name="registrar_usuario" value="Registrarme">

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</center>
</html>