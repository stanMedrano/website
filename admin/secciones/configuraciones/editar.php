<?php
include("../../bd.php");

if (isset($_GET['txtid'])) {

   echo $_GET['txtid'];


   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();

   $registro = $sentencia->fetch(PDO::FETCH_LAZY);


   $nombreconfiguracion = $registro['nombreconfiguracion'];
   $valor = $registro['valor'];
}


if ($_POST) {
   //Recepcionar datos del formulario
   $txtid = (isset($_POST['txtid'])) ? $_POST['txtid'] : "";
   $nombreconfiguracion = (isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion'] : "";
   $valor = (isset($_POST['valor'])) ? $_POST['valor'] : "";

   $sentencia = $conexion->prepare("UPDATE tbl_configuraciones
   SET nombreconfiguracion=:nombreconfiguracion,
   valor=:valor
   WHERE id=:id");


   $sentencia->bindParam(":nombreconfiguracion", $nombreconfiguracion);
   $sentencia->bindParam(":valor", $valor);
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();
   $mensaje = "Registro actualizado con exito.";
   header("Location:index.php?mensaje=" . $mensaje);

}

include("../../template/header.php");
?>


<div class="card">
   <div class="card-header">Editar Configuracion </div>
   <div class="card-body">

      <form action="" method="post">
         <div class="mb-3">
            <label for="id" class="form-label">Id:</label>
            <input readonly value="<?php echo  $txtid; ?>" type="text" class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="Id" />
         </div>


         <div class="mb-3">
            <label for="nombreconfiguracion" class="form-label">Nombre:</label>
            <input readonly type="text" value="<?php echo  $nombreconfiguracion; ?>" class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la configuracion" />

         </div>

         <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <input type="text" value="<?php echo  $valor; ?>" class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor" />

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