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
                $id = $row['id_proyecto'];
                $id_est = $row['id_estudiante'];
                $nombre_proyec = $row['Nombre'];
                $descripcion = $row['descripción'];
                $ubicacion = $row['ubicacion'];
                $estado = $row['estado_proyecto'];
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


    <!-- Se muestra los detalles de cada proyecto  -->
    <section class="contenedor detalles">
        <object data="documentos/<?php echo $row['id_proyecto'];?>.pdf" type="application/pdf" class="pdf"></object>
        <h2>Nombre del proyecto: <?php echo $row['Nombre'];; ?></h2>
        <h2>Autor: <?php echo $row['primer_nombre'], ' ', $row['segundo_nombre'], ' ', $row['primer_apellido'], ' ', $row['segundo_apellido']; ?></h2>
        <h2>Estado: <?php if($row['estado_proyecto'] == 1){
            echo 'Activo';
        }else{
            echo 'Inactivo';
        } ?></h2>
        <h2>Año: <?php echo $row['año'];?></h2>
    </section>


    <!-- Se muestra el foro de discusion -->
    <section class="contenedor foro">
        <h1>Foro</h1>
    </section>


    <a href="proyectos.php">Volver</a>
</body>
</html>

