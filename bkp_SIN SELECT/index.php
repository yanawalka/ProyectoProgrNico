<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>Loggin</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="plugins\sweet_alert2\sweetalert2.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="card">
                    
                        <form onsubmit="event.preventDefault()" id="formLogin" class="box" action="" method="post">
                            <h1>Iniciar Sesion</h1>
                            <p class="text-muted"> Ingrese su susuario y contraseña!</p>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                            <input type="password" name="clave" id="clave" class="form-control"
                                placeholder="Contraseña">
                            <input type="submit" name="submit" class="btn-dark btn-lg " value="INGRESAR!">
                            <a class="forgot text-muted" href="vistas/paginas/registro.php">Registrarse</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>

    <script src="plugins\sweet_alert2\sweetalert2.all.min.js"></script>

    <script src="login.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>

</html>