<?php

include("../../bd.php");


if (isset($_GET['txtid'])) {
   //borar registro por id
   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

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

   $sentencia = $conexion->prepare("DELETE FROM tbl_equipo WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();
}

//selecionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_equipo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../template/header.php");
?>

<div class="card">
   <div class="card-header">
      <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Miembro del equipo</a>
   </div>
   <div class="card-body">
      <div class="table-responsive-md">
         <table class="table table-info">
            <thead>
               <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Nombre Completo</th>
                  <th scope="col">Puesto</th>
                  <th scope="col">Redes sociales</th>

                  <th scope="col">Acciones</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($lista_equipo as $registros) { ?>
                  <tr class="">
                     <td scope="row"><?php echo $registros['id']; ?></td>
                     <td><img width="60" src="../../../assets/img/team/<?php echo $registros['imagen']; ?>" alt=""></td>
                     <td><?php echo $registros['nombrecompleto']; ?></td>
                     <td><?php echo $registros['puesto']; ?></td>
                     <td>
                        <?php echo $registros['facebook']; ?>
                        <br><?php echo $registros['twitter']; ?>
                        <br><?php echo $registros['linkedin']; ?>
                     </td>

                     <td><a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id']; ?>" role="button">Editar</a>
                        |<a name="" id="" class="btn btn-danger" href="index.php?txtid=<?php echo $registros['id']; ?>" role="button">Eliminar</a>
                     </td>
                  </tr>
               <?php               }               ?>
            </tbody>
         </table>
      </div>

   </div>

</div>


<?php
include("../../template/footer.php");
?>