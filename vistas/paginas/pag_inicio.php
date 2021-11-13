<?php 
session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null){
	header("Location: ../../index.php");
}else{
    if($_SESSION["s_idRol"]==3){
        header("Location: pag_inicioUsuario.php");
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweet_alert2/sweetalert2.min.css">

    <link rel="stylesheet" href="../../src/pag_inicio.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Login con PHP - Bootstrap 4</title>
</head>

<body>


    <nav class="menum navbar navbar-light navbar-expand-md justify-content-center fixed-top">
        <div class="container">

            <div class="navbar-collapse collapse justify-content-between align-items-center w-100"
                id="collapsingNavbar2">
                <ul class="topBotomBordersOut navbar-nav mx-auto text-center">
                    <li class="nav-item"><a class="nav-link font-weight-light" href="../crudUsuarios">USUARIOS</a></li>
                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../crudProductos">PRODUCTOS</a></li>
                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../crudMarcas">MARCAS</a></li>
                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../crudProveedores">PROVEEDORES</a></li>
                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../crudRoles">ROLES</a></li>
                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../../bd/logica_logout.php">CERRAR SESION</a></li>


                </ul>
            </div>
        </div>
    </nav>
    </div>
    <div>
        <a class="btn btn-danger btn-lg" href="../bd/logica_logout.php" role="button">
            Cerrar Sesión
        </a>
    </div>


    <!-- <div class="container">
    <div class="row">
        <div class="col-lg-12">
        <div class="jumbotron">
          <h1 class="display-4 text-center">¡Bienvenido ADMINISTRADOR!</h1>
          <h2 class="text-center">Usuario: <span class="badge badge-success"><?php echo $_SESSION["s_usuario"];?></span></h2>            
          <a class="btn btn-danger btn-lg" href="../bd/logica_logout.php" role="button">Cerrar Sesión</a>
        </div>
        </div>
    </div>
</div>     -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script src="../plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>
</body>

</html>