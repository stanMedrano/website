<?php
include("../../bd.php");

//selecionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuracion = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../template/header.php");
?>

<div class="card">
   <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Configuracion</a></div>
   <div class="card-body">

      <div class="table-responsive-sm">
         <table class="table table-warning">
            <thead>

               <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre de la configuracion</th>
                  <th scope="col">Valor</th>
                  <th scope="col">Accion</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($lista_configuracion as $registros) { ?>
                  <tr class="">
                     <td scope="row"><?php echo $registros['id']; ?></td>
                     <td><?php echo $registros['nombreconfiguracion']; ?></td>
                     <td><?php echo $registros['valor']; ?></td>
                     <td><a name="" id="" class="btn btn-info" href="editar.php?txtid=<?php echo $registros['id']; ?>" role="button">Editar</a>
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