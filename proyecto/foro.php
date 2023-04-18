<?php   
    require 'database/privacidad.php';
    require 'database/conexion.php';
    $db = new Database();
    $con = $db -> conectar();
    
    $id = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id == '' || $token == ''){
        echo 'Error al procesar la peticion 1 ';
        exit;
    }else{
        $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
    
        if($token == $token_tmp){
            $sql = $con -> prepare("SELECT count(id_proyecto) FROM proyecto p INNER JOIN usuario u ON u.id_usuario = p.id_estudiante WHERE id_proyecto = $id");
            $sql -> execute();
            if($sql -> fetchColumn() > 0){
                $sql = $con -> prepare("SELECT * FROM proyecto p INNER JOIN usuario u ON p.id_estudiante = u.id_usuario WHERE id_proyecto = $id");
                $sql -> execute();
                $row = $sql ->fetch(PDO::FETCH_ASSOC);
            }
        }else{
            echo 'Error al procesar la peticion 2';
            exit;
        }
    }

?>


<?php include('includes/header.php')?>

<body>
    <!-- header -->
    <section class="contenedor header_pI">
        <h1>Apartado de proyecto individual</h1>
    </section>

    <!-- PRUEBA PROYECTO 1 A 1 -->

    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="ver_proyecto.php">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" >Foro</a>
                </li>
            </ul>
        </div>
        <div class="card-body; mh-100" style="width: 50vh; height: 50vh;">
            <a href="ver_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'];?>&token=<?php echo hash_hmac('sha1', $row['id_proyecto'], KEY_TOKEN); ?>" class="btn btn-outline-info">Rregresar</a>
        </div>
    </div>

    
</body>
</html>

