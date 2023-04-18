<?php
    require 'database/privacidad.php';
    require 'database/conexion.php';
    $db = new Database();
    $con = $db -> conectar();
    
    $sql = $con -> prepare("SELECT id_proyecto, Nombre, descripción, ubicacion, estado_proyecto FROM proyecto");
    $sql -> execute();
    $resultado = $sql -> fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("includes/header.php") ?>


<body>
    <!-- Barra de busqueda de los proyectos actuales -->
    <section class="contenedor busqueda">
        <h1>Apartado de busqueda y filtros</h1>
        
    </section>


    <!-- Se muestran los proyectos -->

    <section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="f0">Proyectos Disponibles</h1>
            </p>
        </div>
    </div>
    </section>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-5">
            <?php foreach($resultado as $row){?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php 
                            $id = $row['id_proyecto'];
                            $documento = "documentos/$id/1.pdf";

                            if(!file_exists($documento)){
                                $documento = "documentos/doc.png";
                            }
                            ?>
                                <!-- muestra cada uno de los proyetos -->
                        <img class="border border-info" src="<?php echo $documento ?>">
                        <div class="card-body">  
                            <h3 class="card-title"><?php echo $row['Nombre']; ?></h3>
                            <div class="d-flex justify-content-between aling-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-outline-secondary" href="ver_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'];?>&token=<?php echo 
                                    hash_hmac('sha1', $row['id_proyecto'], KEY_TOKEN); ?>" role="button">Ver Detalles</a>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>        

    
</body>
</html>

