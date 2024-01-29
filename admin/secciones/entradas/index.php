<?php
include("../../bd.php");

if (isset($_GET['txtid'])) {
   //borar registro por id
   echo $_GET['txtid'];

   $txtid = (isset($_GET['txtid'])) ? $_GET['txtid'] : "";

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

   $sentencia = $conexion->prepare("DELETE FROM tbl_entradas WHERE id=:id");
   $sentencia->bindParam(":id", $txtid);
   $sentencia->execute();
}
//selecionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../template/header.php");
?>

<div class="card">
   <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro de nosotros</a></div>
   <div class="card-body">

      <div class="table-responsive-sm">
         <table class="table table-dark">
            <thead>
               <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Titulo</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Descripción</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($lista_entradas as $registros) { ?>
                  <tr class="">
                     <td><?php echo $registros['id']; ?></td>
                     <td><?php echo $registros['fecha']; ?></td>
                     <td><?php echo $registros['titulo']; ?></td>
                     <td><?php echo $registros['descripcion']; ?></td>
                     <td><img width="60" src="../../../assets/img/about/<?php echo $registros['imagen']; ?>" alt=""></td>
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