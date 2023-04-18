<?php
    require 'database/privacidad.php';
    require 'database/conexion.php';
    $db = new Database();
    $con = $db -> conectar();
    
    $sql = $con -> prepare("SELECT id_proyecto, Nombre, descripción, ubicacion, estado_proyecto FROM proyecto");
    $sql -> execute();
    $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
</head>
<body>
    <!-- Barra de busqueda de los proyectos actuales -->
    <section class="contenedor busqueda">
        <h1>Apartado de bsuqueda y filtros</h1>
        
    </section>


    <!-- Se muestran los proyectos -->


    <section class="contenedor proyectos">
        <h1>Proyectos vista general, nombre, resumen y datos</h1>
            <?php foreach($resultado as $row){?>
                <?php 
                    $id = $row['id_proyecto'];
                    $documento = "documentos/$id/1.pdf";

                    if(!file_exists($documento)){
                        $documento = "documentos/no-doc.jpg";
                    }
                ?>

                <!-- muestra cada uno de los proyetos -->
                
                <div class="contenedor unico">  
                    <figure>
                        <img src="documentos/doc.png" alt="icono documeto">
                    </figure>
                    <h2 class="titulo_proyectos"><?php echo $row['Nombre']; ?></h2>
                    <a href="ver_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'];?>&token=<?php echo 
                    hash_hmac('sha1', $row['id_proyecto'], KEY_TOKEN); ?>" class="btn
                    ver">Ver Detalles</a>

            </div>
        <?php } ?>

    </section>

</body>
</html>

