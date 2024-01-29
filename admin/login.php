<?php
session_start();
include("./bd.php");


if ($_POST) {
    //Recepcionar datos del formulario
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";

    //selecionar registros
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario FROM `tbl_usuarios`
WHERE usuario=:usuario
AND password=:password");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY);

    if ($lista_usuarios['n_usuario'] > 0) {
        print_r("El usuarios y contraseña existe");
        $_SESSION['usuario'] = $lista_usuarios['usuario'];
        $_SESSION['logueado'] = true;
        header("Location:index.php");
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Ingresar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
<br><br>
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">

                <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong><?php echo $mensaje; ?></strong>
                </div>
            <?php endif; ?>
                    <div class="card">
                        <div class="card-header text-center">Entrar al sistema</div>
                        <div class="card-body">

                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" />
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="contrasenia" id="password" aria-describedby="helpId" placeholder="" />

                                </div>

                                <input name="" id="" class="btn btn-primary" type="submit" value="Entrar" />


                            </form>
                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>

                </div>

            </div>
        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>