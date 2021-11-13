<?php
include '../../bd/conexion.php';

session_start();

//Si nadie inció sesión vuelve a la pag de Login
if ($_SESSION["s_usuario"] === null){
	header("Location: ../index.php");
}else{
    if($_SESSION["s_idRol"]!=1){
        header("Location: pag_error.php");
    }
}

$objeto = new Conexion();
$conexion = $objeto->Conectar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>CRUD</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <!-- <link rel="stylesheet" href="../../src/crudsTable.css"> -->
    <link rel="stylesheet" href="main.css">
    <!-- navbar -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--datables CSS básico-->
    <!-- <link rel="stylesheet" type="text/css" href="../../datatables/datatables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="../../DataTables-1.11.3/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="../../Buttons-2.0.1/css/buttons.bootstrap5.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css"/> -->
    <!--datables estilo bootstrap 4 CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="../../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"> -->
    <!-- Google Icon API -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <header>
        <div class="grid">
            <div class="element1 align-middle">
                <div class="contenedor1 ">
                    <h3 class=" nomcrud text-center text-light  ">USUARIOS</h3>
                </div>
            </div>
        
            <div class="element2">
                <div class="contenedor2">
                    <nav class="menum navbar navbar-light navbar-expand-md justify-content-center ">
                        <div class="container">
                            <div class="navbar-collapse collapse justify-content-between align-items-center w-100"
                                id="collapsingNavbar2">
                                <ul class="topBotomBordersOut navbar-nav mx-auto text-center">
                                    <li class="nav-item"> <a class="nav-link font-weight-light" href="../paginas/pagina_inico.php">MENU PRINCIPAL</a></li>
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
            </div>

            <div class="element3">
                <div class="contenedor3 ">
                    <h5 class="nomUsuario">Usuario: <?php echo $_SESSION["s_usuario"];?></h5>
                </div>
            </div>
            
        </div>




    </header>
<div class="secTabla">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id='btnNuevo' type='button' class='btn btn-success btnNuevo ' data-toggle='modal'>
                    Nueva Entrada
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                        style="width:100%">

                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Clave</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="usuario" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usuario">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="clave" class="col-form-label">Clave:</label>
                            <input type="text" class="form-control" id="clave">
                        </div>

                        <div class="form-group">
                            <select class="custom-select my-1 mr-sm-2" id="idRol" name='idRol'>
                                <option selected>Seleccione rol...</option>
                                <?php
                                $consulta = "SELECT id, descripcion FROM roles ORDER BY id ASC " ;
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                $numero=count($data);
                                for($i=0; $i<$numero; $i++){
                                $valor = $data[$i]['id'];
                                $descripcion = $data[$i]['descripcion'];
                                echo "<option value="."'".$valor."'>".$descripcion."</option>";
                                }
                                ?>
                            </select>

                            <!-- <label for="idRol" class="col-form-label">Rol:</label>
                            <input type="text" class="form-control" id="idRol"> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- navbar Script -->
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
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../../jquery/jquery-3.3.1.min.js"></script>
    <script src="../../popper/popper.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <!-- <script type="text/javascript" src="../../datatables/datatables.min.js"></script> -->
    <!-- <script type="text/javascript" src="../../DataTables/datatables.min.js"></script> -->
    <script type="text/javascript" src="main.js"></script>


    <script type="text/javascript" src="../../datatables/datatables.min.js"></script>
</body>

</html>