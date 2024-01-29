<?php

include("../../bd.php");

if (isset($_GET['txtid'])) {
   //borar registro por id
   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();

   $registro = $sentencia->fetch(PDO::FETCH_LAZY);

   $icono = $registro['icono'];
   $titulo = $registro['titulo'];
   $descripcion = $registro['descripcion'];
}

if ($_POST) {
   print_r($_POST);

   //Recepcionar datos del formulario
   $id = (isset($_POST['id'])) ? $_POST['txtid'] : "";
   $icono = (isset($_POST['icono'])) ? $_POST['icono'] : "";
   $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
   $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

   $sentencia = $conexion->prepare("UPDATE tbl_servicios
   SET icono=:icono,titulo=:titulo,descripcion=:descripcion
   WHERE id=:id");

   $sentencia->bindParam(":icono", $icono);
   $sentencia->bindParam(":titulo", $titulo);
   $sentencia->bindParam(":descripcion", $descripcion);
   $sentencia->bindParam(":id", $txtid);

   $sentencia->execute();
   $mensaje = "Registro modificado con exito.";
   header("Location:index.php?mensaje=" . $mensaje);
}

include("../../template/header.php");
?>

<div class="card">
   <div class="card-header">Editar Servicio</div>
   <div class="card-body">

      <form action="" enctype="multipart/form-data" method="post">
      

         <div class="mb-3">
            <label for="txtid" class="form-label">ID:</label>
            <input readonly value="<?php echo $txtid; ?>" type="text" class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="ID" />

         </div>


         <div class="mb-3">
            <label for="icono" class="form-label">Icono:</label>
            <input value="<?php echo $icono; ?>" type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
         </div>

         <div class="mb-3">
            <label for="titulo" class="form-label">Titulo:</label>
            <input value="<?php echo $titulo; ?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
         </div>

         <div class="mb-3">
            <label for="descripcion" class="form-label">Descipción</label>
            <input value="<?php echo $descripcion; ?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descipción" />
         </div>

         <button type="submit" class="btn btn-success">
            Actualizar
         </button>

         <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>




      </form>


   </div>
   <div class="card-footer text-muted"></div>
</div>


<?php
include("../../template/footer.php");
?>