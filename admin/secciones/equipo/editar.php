<?php
include("../../bd.php");
//seleccionar registro por id
if (isset($_GET['txtid'])) {

   echo $_GET['txtid'];


   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();

   $registro = $sentencia->fetch(PDO::FETCH_LAZY);


   $imagen = $registro['imagen'];
   $nombrecompleto = $registro['nombrecompleto'];
   $puesto = $registro['puesto'];
   $twitter = $registro['twitter'];
   $facebook = $registro['facebook'];
   $linkedin = $registro['linkedin'];
}

if ($_POST) {
   //Recepcionar datos del formulario
   $txtid = (isset($_POST['txtid'])) ? $_POST['txtid'] : "";
   $imagen = (isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name'] : "";
   $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : "";
   $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : "";
   $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
   $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
   $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : "";

   $sentencia = $conexion->prepare("UPDATE tbl_equipo
   SET nombrecompleto=:nombrecompleto,
   puesto=:puesto,
   twitter=:twitter,
   facebook=:facebook,
   linkedin=:linkedin
   WHERE id=:id");


   $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
   $sentencia->bindParam(":puesto", $puesto);
   $sentencia->bindParam(":twitter", $twitter);
   $sentencia->bindParam(":facebook", $facebook);
   $sentencia->bindParam(":linkedin", $linkedin);
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();


   if ($_FILES['imagen']['tmp_name'] != "") {
      $imagen = (isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name'] : "";
      $fecha_imagen = new DateTime();
      $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";


      $tmp_imagen = $_FILES['imagen']['tmp_name'];
      move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombre_archivo_imagen);

      //borrado del archivo anterior
      $sentencia = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
      $sentencia->bindParam(":id", $txtid);
      $sentencia->execute();
      $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

      if (isset($registro_imagen["imagen"])) {
         if (file_exists("../../../assets/img/team/" . $registro_imagen["imagen"])) {
            unlink("../../../assets/img/team/" . $registro_imagen["imagen"]);
         } else {
            echo "No hay imagen";
         }
      }


      $sentencia = $conexion->prepare("UPDATE tbl_equipo
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
   <div class="card-header">Editar datos del personal del Equipo</div>
   <div class="card-body">
      <form action="" enctype="multipart/form-data" method="post">
         <div class="mb-3">
            <label for="txtid" class="form-label">Id:</label>
            <input value="<?php echo  $txtid; ?>" readonly type="text" class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="ID" />
         </div>


         <div class="mb-3">
            <img width="60" src="../../../assets/img/team/<?php echo $imagen; ?>" alt="">

            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control bg-success text-light" name="imagen" id="imagen" aria-describedby="helpId" />
            <small id="helpId" class="form-text text-muted">Seleccione una imagen para cargar.</small>
         </div>


         <div class="mb-3">
            <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
            <input value="<?php echo  $nombrecompleto; ?>" type="text" class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre Completo" />
         </div>

         <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <input value="<?php echo  $puesto; ?>" type="text" class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
         </div>

         <div class="mb-3">
            <label for="twitter" class="form-label">Twiter:</label>
            <input value="<?php echo  $twitter; ?>" type="text" class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="twitter" />

         </div>

         <div class="mb-3">
            <label for="facebook" class="form-label">Facebook:</label>
            <input value="<?php echo  $facebook; ?>" type="text" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook" />
         </div>

         <div class="mb-3">
            <label for="linkedin" class="form-label">Linkedin:</label>
            <input value="<?php echo  $linkedin; ?>" type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin" />
         </div>

         <button type="submit" class="btn btn-success">
            Actualizar
         </button>

         <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

      </form>




   </div>
</div>


<?php
include("../../template/footer.php");
?>