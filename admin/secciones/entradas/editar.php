<?php
include("../../bd.php");

if (isset($_GET['txtid'])) {

   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("SELECT * FROM tbl_entradas WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();
   $registro = $sentencia->fetch(PDO::FETCH_LAZY);

   $fecha = $registro['fecha'];
   $titulo = $registro['titulo'];
   $imagen = $registro['imagen'];
   $descripcion = $registro['descripcion'];
}


if ($_POST) {
   //Recepcionar datos del formulario
   $txtid = (isset($_POST['txtid'])) ? $_POST['txtid'] : "";
   $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
   $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
   $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
   //actualizar los datos en la tabla 
   $sentencia = $conexion->prepare("UPDATE tbl_entradas
   SET fecha=:fecha,titulo=:titulo,descripcion=:descripcion
   WHERE id=:id");

   $sentencia->bindParam(":fecha", $fecha);
   $sentencia->bindParam(":titulo", $titulo);
   $sentencia->bindParam(":descripcion", $descripcion);
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();


   if ($_FILES['imagen']['tmp_name'] != "") {
      $imagen = (isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name'] : "";
      $fecha_imagen = new DateTime();
      $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";


      $tmp_imagen = $_FILES['imagen']['tmp_name'];
      move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombre_archivo_imagen);

      //borrado del archivo anterior
      $sentencia = $conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id");
      $sentencia->bindParam(":id", $txtid);
      $sentencia->execute();
      $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

      if (isset($registro_imagen["imagen"])) {
         if (file_exists("../../../assets/img/about/" . $registro_imagen["imagen"])) {
            unlink("../../../assets/img/about/" . $registro_imagen["imagen"]);
         } else {
            echo "No hay imagen";
         }
      }

      $sentencia = $conexion->prepare("UPDATE tbl_entradas
      SET imagen=:imagen WHERE id=:id");

      $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
      $sentencia->bindParam(":id", $txtid);
      $sentencia->execute();
      $imagen = $nombre_archivo_imagen;
   }
   $mensaje = "Registro actualizado con exito.";
   header("Location:index.php?mensaje=" . $mensaje);
}

include("../../template/header.php");
?>
<div class="card">
   <div class="card-header">Entradas</div>
   <div class="card-body">

      <form action="" method="post" enctype="multipart/form-data">
         <div class="mb-3">
            <label for="txtid" class="form-label">Id:</label>
            <input type="text" readonly value="<?php echo $txtid; ?>" class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="Id" />

         </div>

         <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" value="<?php echo $fecha; ?>" name="fecha" id="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha" />
         </div>

         <div class="mb-3">
            <label for="titulo" class="form-label">Titulo:</label>
            <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />

         </div>

         <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />

         </div>

         <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <img width="60" src="../../../assets/img/about/<?php echo $imagen; ?>" alt="">
            <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId" />

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