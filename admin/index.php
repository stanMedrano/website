<?php
include("bd.php");
//selecionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


   include("./template/header.php");
?>
<br>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenido al administrador del sitio web</h1>
        <p class="col-md-8 fs-4">
            Aca podras actualizar y eliminar la informacion del sitio web
        </p>
        <a name="" id="" class="btn btn-danger" href="../admin/secciones/servicios/index.php" role="button">Iniciar</a>
    </div>
</div>





<?php
   include("./template/footer.php");
?>