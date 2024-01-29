<?php
include("../../bd.php");

if (isset($_GET['txtid'])) {
   //borar registro por id
   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

   $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();
}

//selecionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
include("../../template/header.php");
?>

<div class="card">
   <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a></div>
   <div class="card-body">

      <div class="table-responsive-sm">
         <table class="table table-success">
            <thead>
               <tr>
                  <th scope="col">Usuario</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Contraseña</th>
                  <th scope="col">Acciones</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($lista_usuario as $registros) { ?>
                  <tr class="">
                     <td scope="row"><?php echo $registros['usuario']; ?></td>
                     <td><?php echo $registros['correo']; ?></td>
                     <td><?php echo $registros['password']; ?></td>
                     <td><a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id']; ?>" role="button">Editar</a>
                        |<a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $registros['id']; ?>" role="button">Eliminar</a>
                     </td>
                  </tr>
               <?php    }    ?>
            </tbody>
            </tbody>
         </table>
      </div>


   </div>

</div>


<?php
include("../../template/footer.php");
?>