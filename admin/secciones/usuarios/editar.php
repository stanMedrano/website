<?php
include("../../bd.php");
//selecionar datos a la tabla
if (isset($_GET['txtid'])) {
   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();

   $registro = $sentencia->fetch(PDO::FETCH_LAZY);

   $usuario = $registro['usuario'];
   $password = $registro['password'];
   $correo = $registro['correo'];
}

if ($_POST) {
   print_r($_POST);

   //Recepcionar datos del formulario
   $id = (isset($_POST['id'])) ? $_POST['txtid'] : "";
   $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
   $password = (isset($_POST['password'])) ? $_POST['password'] : "";
   $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

   $sentencia = $conexion->prepare("UPDATE tbl_usuarios
   SET usuario=:usuario,password=:password,correo=:correo
   WHERE id=:id");

   $sentencia->bindParam(":usuario", $usuario);
   $sentencia->bindParam(":password", $password);
   $sentencia->bindParam(":correo", $correo);
   $sentencia->bindParam(":id", $txtid);

   $sentencia->execute();
   $mensaje = "Registro modificado con exito.";
   header("Location:index.php?mensaje=" . $mensaje);
}


include("../../template/header.php");
?>

<div class="card">
   <div class="card-header">Crear usuario</div>
   <div class="card-body">
      <form action="" method="post">

         <div class="mb-3">
            <label for="txtid" class="form-label">ID:</label>
            <input readonly value="<?php echo $txtid; ?>" type="text" class="form-control" name="txtid" id="txtid" aria-describedby="helpId" placeholder="ID" />

         </div>
         <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
         </div>

         <div class="mb-3">
            <label for="" class="form-label">Contraseña:</label>
            <input value="<?php echo $password; ?>" type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña" />
         </div>
         <div class="mb-3">
            <label for="correo" class="form-label">Email</label>
            <input value="<?php echo $correo; ?>" type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Escribe tu correo" />

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