<?php
include("../../bd.php");
if ($_POST) {
   //Recepcionar datos del formulario
   $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
   $password = (isset($_POST['password'])) ? $_POST['password'] : "";
   $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";


   $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios` (`id`, `usuario`, `password`, `correo`) 
   VALUES (NULL,:usuario, :password, :correo);");

   $sentencia->bindParam(":usuario", $usuario);
   $sentencia->bindParam(":password", $password);
   $sentencia->bindParam(":correo", $correo);
   $sentencia->execute();
   $mensaje = "Registro creado con exito.";
   header("Location:index.php?mensaje=" . $mensaje);
}
include("../../template/header.php");
?>

<div class="card">
   <div class="card-header">Crear usuario</div>
   <div class="card-body">
      <form action="" method="post">

         <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
         </div>

         <div class="mb-3">
            <label for="" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña" />
         </div>
         <div class="mb-3">
            <label for="correo" class="form-label">Email</label>
            <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Escribe tu correo" />

         </div>
         <button type="submit" class="btn btn-success">
            Agregar
         </button>

         <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

      </form>
   </div>

</div>



<?php
include("../../template/footer.php");
?>