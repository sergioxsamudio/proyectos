
<?php


include("conexionDB.php");



if (isset($_POST["registrar_usuario"])) {

    $primer_nombre = $_POST["primer_n"];
    $segundo_nombre = $_POST["segundo_n"];
    $apellido_paterno = $_POST["apellido_p"];
    $apellido_materno = $_POST["apellido_m"];
    $correo = $_POST["correo_user"];
    $contraseña = $_POST["Contraseña_user"];
    $programa = $_REQUEST['program'];
    $imagen = '';



    $verificarCorreo = mysqli_query($mysqli, "SELECT * FROM usuario WHERE correo='$correo'");
    if (mysqli_num_rows($verificarCorreo) > 0) {
        $mensaje = "Este correo ya está registrado, intenta con otro diferente";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = 'index.html';";
        echo "</script>";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        exit();
    }

    if (isset($_FILES["foto"])) {
        $file = $_FILES["foto"];
        $nombre = $file["name"];
        $tipo = $file["typo"];
        $ruta_provisional = $file["tmp_name"];
        $size = $file["size"];
        $dimensiones = getimagesize($ruta_provisional);
        $width = $dimensiones[0];
        $height = $dimensiones[1];
        $carpeta = "fotos/";
        if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
            echo "Error el archivo no es imagen";
        }
        else if ($size > 3*1024*1024){
            echo "Error el tamaño máximo permitido es un 3MB";
        }
        else {
            $src = $carpeta.$nombre;
            move_uploaded_file($ruta_provisional, $src);
            $imagen="fotos/".$nombre;
        }
        
    }

    $query = "INSERT INTO usuario(primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo, contraseña, id_programa, foto)
                    VALUES ('$primer_nombre', '$segundo_nombre', '$apellido_paterno',
                    '$apellido_materno', '$correo', '$contraseña', '$programa', '$imagen')";

    $mensaje = "Ha sido registrado exitosamente";
    echo "<script>";
    echo "alert('$mensaje');";
    echo "window.location = 'index.html';";
    echo "</script>";
    echo "<script type='text/javascript'>alert('$msg');</script>";

    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die("Query Failed");
    }

    $_SESSION['message'] = '¡ Ha sido registrado exitosamente !';
    $_SESSION['message_type'] = 'success';

    header("Location: index.html");
}

?>